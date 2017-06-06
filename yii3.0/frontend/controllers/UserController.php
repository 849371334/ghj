<?php

namespace frontend\controllers;

use Yii;
use frontend\models\WcUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helps\Ectype;
use frontend\models\Rule;


/**
 * @brief 用户管理控制器
 * @author 微信小组
 * UserController implements the CRUD actions for Group model.
 */
//定义常量
define('success',1);//成功
define('danger',2); //危险

class UserController extends Controller
{
    //去掉公共样式
    public $layout = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     *  注册模块
     * @return string
     */
    public function actionRegist()
    {
        //判断传过来的数据是否是POST数据
        if (yii::$app->request->isPost)
        {
            //接收数据
            $regist_data = yii::$app->request->post();
            //取出密码
            $password = $regist_data['password'];
            //实例化加密类
            $encrypt = new Ectype();
            //密码进行加密
            $encrypt_password = $encrypt->md8($password);
            //定义空数组存放新数据
            $arr = array();
            //实例化注册模型层
            $wcModel = new WcUser();
            $arr['username'] = $regist_data['username'];
            $arr['password'] = $encrypt_password;
            $arr['mobile'] = $regist_data['mobile'];
            $arr['email'] = $regist_data['email'];
            $arr['time'] = time();
            //调用模型层查询的方法
            $query=$wcModel->regist_select($arr);
            if ($query)
            {
                return 2;
            } else {
                //调用模型层添加方法
                $result = $wcModel->regist_add($arr);
                if ($result)
                {
                    $uid=Yii::$app->db->getLastInsertId();
                    $role = new Rule();
                    $role->add2($uid);
                    return 1;
                } else {
                    return 0;
                }
            }
        } else {
            return $this->render('regist');
        }
    }

    /**
     * xss 攻击验证
     * @param $xss
     * @return int
     */
    public function actionXss($xss)
    {
        foreach ($xss as $k => $v) {
            if(preg_match("/[\':;`%^&)(<>{}]|\]|\[|\/|\\\|\"|\|/",$v)){
                return danger;
            }
        }
        return success;
    }

    /**
     * author jiang
     * [actionPwd_callback description]
     * @return [type] [description]
     */
    public function actionPwd_callback()
    {
        $request = yii::$app->request;
        if ($request->isPost) {
            $username = $request->post('username');
            $type = $request->post('type');
            if (stripos($type,'@') == true) {
                $bool = WcUser::find()
                    ->select('id')
                    ->where(['username' => $username, 'email' => $type])
                    ->asArray()
                    ->One();
                if ($bool) {
                    //加密发送邮件
                    $id = $bool['id'];
                    $host = $request->hostInfo;
                    $homeurl = yii::$app->homeUrl;
                    $url = $host.$homeurl."?r=user/resetpwd";
                    echo $this->actionEmailsend($id, $url);
                }
            } else {
                return '手机找回未开通';
            }
        } else {
            return $this->render('pwd_callback');
        }
    }

    //发送邮件
    /**
     * author jiang
     * [actionEmailsend description]
     * @param  [type] $id  [description]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function actionEmailsend($id,$url)
    {
        $mail = Yii::$app->mailer->compose();
        $info = WcUser::find()
            ->where(['id' => $id])
            ->asArray()
            ->One();
        $mail->setTo($info['email']);
        $mail->setSubject("微信平台-密码找回");
        $link = $url."&id=".base64_encode($id);
        $html = "<br>".$info['username']."<br/>"."确认请点击下方链接".$link;
        $mail->setHtmlBody($html);    //发布可以带html标签的文本
        $mail->send();
        if ($mail->send()) {
            return "success";
        } else {
            return "false";
        }
    }
    //重新设置密码
    /**
     * author jiang
     * [actionResetpwd description]
     * @return [type] [description]
     */
    public function actionResetpwd()
    {
        $request = yii::$app->request;
        if ($request->isPost) {
            $pwd = $request->post('password');
            $repwd = $request->post('repassword');
            $id = base64_decode($request->post('id'));
            if ($pwd == $repwd) {
                //实例化加密类
                $encrypt = new Ectype();
                //密码进行加密
                $encrypt_password=$encrypt->md8($pwd);
                $model = new WcUser();
                $bool = $model->updateAll(array('password'=>$encrypt_password), array('id'=>$id));
                if (isset($bool)) {
                    return $this->redirect('index.php?r=user/login');
                }
            }
        }
        return $this->render('reset_pwd');
    }


    public function actionTest()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('test',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    public function actionNews()
    {

        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/图文设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('news',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    public  function  actionImg()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/音乐设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('img',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    public  function  actionVoice()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/语音设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('voice',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    public  function  actionVideo()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/视频设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('video',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }


    /*
     * 非法登陆跳转
     * */
    public  function  actionFan()
    {
       return  $this->render('redict2');
    }

    /*
     * 无权限跳转
     * */
    public  function  actionNode()
    {
       return $this->render('redict_node');
    }
}


