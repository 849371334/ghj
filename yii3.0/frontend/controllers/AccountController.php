<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\models\Account;
use frontend\models\Rule;
use frontend\models\Group;
use frontend\models\Limit;
use frontend\models\WcUser;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * @brief 公众号控制器
 * AccountController implements the CRUD actions for Account model.
 */

define('BEST_PHPER',serialize(array('admin','admin1')));//设置admin管理员

class AccountController extends Controller
{

    /*
     * 去掉公共样式
     * */
    public $layout = false;

    /*
     * 自动加载
     * */
    public  function init()
    {
        //获取到session
        $session = \Yii::$app->session;
        $res = $session->get('user');
        if (!isset($res) || empty($res))
        {
            $this->redirect('index.php?r=login/fan');
        }
    }

    /*
     * 公众号首页列表
     * */
    public  function  actionList()
    {
        //获取到session
        $session = \Yii::$app->session;
        $res = $session->get('user');
        //实例化model层
        $Rule = new Rule();
        $limit = new Limit();
        $Group = new Group();
        $Account = new Account();
        $AccountData = $Account->getAll($res['id']);
        $user = $Rule->getOne($res['id']);
        $GroupData = $Group->getName($user['gid']);

        /*
        * 如果是管理员的话那么无限制
        * */
        if (!in_array($res['username'],unserialize(BEST_PHPER)))
        {
            $LimitData = $limit->getOne($user['gid']);
        } else {
            $LimitData['account_limit'] = '无限制';
        }

        /*
         * post搜索数据
         * */
        $post = yii::$app->request->post();
        if (!empty($post['id']))
        {
            $AccountData = $Account->getOne($post['id'],$res['id']);
            if (!$AccountData)
            {
                return $this->render('delete', ['data' => '信息不存在！']);
            }
                return  $this->render('one',[
                    'data' => $AccountData,
                    'group_name' => $GroupData['group_name'],
                    'big'=> $LimitData['account_limit'],
                    'now' => $Account->getCount($res['id']),
                ]);
        } elseif (!empty($post['name'])) {
                $AccountData = $Account->Search($post['name'],$res['id']);
                if (!$AccountData) {
                return $this->render('delete',['data'=>'信息不存在！']);
            }
                return  $this->render('one',[
                    'data' => $AccountData,
                    'group_name' => $GroupData['group_name'],
                    'big'=> $LimitData['account_limit'],
                    'now' => $Account->getCount($res['id']),
                ]);
        }

        /*
         * 返回数据给页面
         * */
        return  $this->render('list',[
                        'data' => $AccountData,
                        'group_name' => $GroupData['group_name'],
                        'big'=> $LimitData['account_limit'],
                        'now' => $Account->getCount($res['id']),
                    ]);
    }

    /*
     * 公众号添加页面(1)
     * */
    public  function  actionAdd()
    {
        //获取到session
        $session = \Yii::$app->session;
        $res = $session->get('user');
        if (!in_array($res['username'],unserialize(BEST_PHPER)))
        {
            //实例化model层
            $Rule = new Rule();
            $limit = new Limit();
            $Account = new Account();
            $user = $Rule->getOne($res['id']);
            if (is_array($LimitData = $limit->getOne($user['gid'])))
            {
                if ($LimitData['account_limit'] <= $Account->getCount($res['id']))
                {
                    return $this->render('delete', ['data' => '您所在的用户组最多只能创建'.$LimitData['account_limit'].'个主公号！']);
                }
            } else {
                   return $this->render('delete', ['data' => '请核对信息！']);
            }
        }
                   return  $this->render('add');
    }

    /*
    * 公众号添加页面(2)
    * */
    public  function  actionAdd_account()
    {

        return  $this->render('add_account');
    }

    /*
     * 一键获取页面
     * */
    public  function  actionLogin()
    {
        return  $this->render('login');
    }


    /*
    * 公众号上传类
    * */
    public  function  Upload_img($image)
    {
        $upload=new UploadedFile();
        $name=$upload->getInstanceByName($image); //获取文件原名称
        $img=$_FILES[$image]; //获取上传文件参数
        $upload->tempName=$img['tmp_name']; //设置上传的文件的临时名称
        $img_path='uploads/'.$name; //设置上传文件的路径名称(这里的数据进行入库)
        $upload->saveAs($img_path); //保存文件
        return $img_path;
    }

    /*
    * 公众号添加页面(2)
    * */
    public  function  actionAdd_do()
    {
        $post = yii::$app->request->post();
        if (!empty($post['name']))
        {
            /*
             * 获取到添加数据
             * */
            $session = \Yii::$app->session;
            $res = $session->get('user');
            $post['user_id'] = $res['id'];
            $post['qcode'] = $this->Upload_img('qrcode')?$this->Upload_img('qrcode'):0;
            $post['head_url'] = $this->Upload_img('head_url')?$this->Upload_img('head_url'):0;
            /*
             * 实例化入库
             * */
            $Account = new Account();
            if ($Account->addOne($post)) {
                $id = Yii::$app->db->getLastInsertId();
                return $this->redirect('index.php?r=account/set&id='.$id.'');
            } else {
                return $this->render('add_account');
             }
        } else {
            return $this->render('delete', ['data' => '请核对信息！']);
        }
    }

    /*
     * 获取到公众号token
     * 这里暂时写死,仅用于测试需求。
     * */
    public function Gettoken()
    {
        $appid = 'wxcd80607e02d6cb63';
        $appsecret = '25f6f7e450ebb52f7d0b4d30b792f175';
        return json_decode(file_get_contents($url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret"))->access_token;
    }

    /*
     * 添加完成数据
     * */
    public  function  actionSet()
    {
      if ($account_id = intval(yii::$app->request->get('id')))
      {
          $session = \Yii::$app->session;
          $res = $session->get('user');
          $Account = new Account();
          $res = $Account->getOne($account_id,$res['id']);
          return $this -> render('step',[
                    'arr' => $res['name'],
                    'url' =>  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
                    /*
                     * 这里死数据，用于测试。
                     * */
                    'token' => $this->Gettoken(),
          ]);
      } else {
          return  $this->render('add_account');
      }
    }

    /*
     *
     * 删除数据公众帐号信息
     * */
    public  function  actionDelete()
    {
        $Account = new Account();
        if ($Account->deleteOne(intval(yii::$app->request->get('account_id'))))
        {
            return $this->render('delete',['data' => '公众帐号信息删除成功！']);
        } else {
            return $this->render('delete',['data' => '公众帐号信息删除失败！']);
        }
    }

    /*
     * 中间处理页面
     * 获取公众号id入seeion跳转
     * */
    public  function  actionConf()
    {

        if($id = intval(yii::$app->request->get('id')))
        {
            //获取到session
            $session = \Yii::$app->session;
            $res = $session->get('user');
            /*
             * 实例化model查出公众号名称入seesion
             * */
            $Account = new Account();
            $AccountData = $Account->getOne($id,$res['id']);
            $Data['name'] = $AccountData['name'];
            $Data['id'] = $id;
            if (yii::$app->session['account'] = $Data) {
                return $this->redirect('index.php?r=user/news');
            }
        } else {
            return $this->render('delete',['data'=>'请先选定公众号！']);
        }
    }

    /*
     * 查看操作员
     * */
    public  function  actionNode()
    {
        $Rule = new Rule();
        $Group = new Group();
        $session = \Yii::$app->session;
        $res = $session->get('user');
        $user = $Rule->getOne($res['id']);
        $GroupData = $Group->getName($user['gid']);
        return $this->render('node',['data'=> $res,'group' => $GroupData]);
    }

    /*
     * 给用户赋权
     * */
    public  function  actionQuan()
    {
        $session = \Yii::$app->session;
        $res = $session->get('user');
        if ($post = yii::$app->request->post('username')) {
           $User = new WcUser();
            if ($Data = $User->login_sel($post)) {
                $Rule = new Rule();
                $RuleData = $Rule->getOne($res['id']);
                $UserData = $Rule->getOne($Data['id']);
                if ($Data['id'] == $UserData['uid']) {
                     $Rule->del1($Data['id']);
                }
                $array['uid'] =  $Data['id'];
                $array['gid'] =  $RuleData['gid'];
                if ($Rule->add_name($array)) {
                    return "success";
                }
            } else {
                return "用户不存在或已被删除！";
            }
        } else {
            return $this->render('delete',['data' => '请核实信息！']);
        }
    }

    /**
     * @return string|\yii\web\Response
     * @author：zyj
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('account_id');
        if (isset($id)){
            $user = Yii::$app->session->get('user');
            //根据公众号id 和 用户id获取公众号信息
            $accModel = new Account();
            $account = $accModel->account($user['id'],$id);
            return $this->render('update',['account'=>$account]);
        } else {
            return $this->redirect(['account/list']);
        }
    }

    /**
     * @return \yii\web\Response
     * @author：zyj
     */
    public function actionUpdate_do()
    {
        $post = Yii::$app->request->post();
        unset($post['_csrf']);
        $accModel = new Account();
        $res = $accModel->change($post);
        if ($res){
            return $this->redirect(['account/list']);
        } else {
            return $this->redirect(['account/list']);
        }
    }




}
