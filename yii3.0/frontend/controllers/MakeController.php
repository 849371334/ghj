<?php

namespace frontend\controllers;


use Yii;
use common\helps\Ectype;
use yii\filters\VerbFilter;
use app\models\WcFans;
use app\models\WcVip;
use frontend\models\WcVipConfig;
use frontend\models\WcVipUser;
use frontend\models\WcVipValue;

/**
* @brief 粉丝管理控制器
* @author xuruixin
* @email  xuruixin@cn331.com
* MakeController implements the CRUD actions for User model.
*/

class MakeController extends PublicController
{
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
     * @return string
     * 渲染粉丝营销试图
     */
    public function actionFans()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('fans',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    
    /**
     * @return string
     * 渲染粉丝分组试图
     */
    public function actionFans_group()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('fans_group',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    
    /**
     * 分组添加
     */
    public function actionGroup_add()
    {
        if (yii::$app->request->isPost)
        {
            //接收post数据
            $group_data = yii::$app->request->post();
            foreach ($group_data['group_name'] as $k => $v)
            {
                $group_date['group_name'] = $v;
                //实例化模型层
                $model = new WcFans();
                //调用模型层添加分组的方法
                $data = $model->group_add($group_date);
                if ($data)
                {
                    return $this->redirect(['public/message','添加成功','?r=make/group_list','3']);
                } else {
                    return $this->redirect(['public/message','添加失败','?r=make/group_add','3']);
                }
            }
        }
    }
    /**
     * 粉丝分组列表
     */
    public function actionGroup_list()
    {
        //实例化模型层
        $model = new WcFans();
        //调用模型层查询的方法
        $group_query = $model->group_list();
        //模板
        $title = '微站设置/站点设置';
        $keywords = 'wechat demo';
        $description = '';
        return $this -> render('group_list',[
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
            'group_query'=>$group_query,
        ]);
        
    }
    /**
     * 粉丝分组删除
     */
    public function actionGroup_del()
    {
        //接收要删除的用户组id
        $group_id = yii::$app->request->get('group_id');
        //实例化模型层
        $model = new WcFans();
        //调用模型层删除的方法
        $group_delete=$model->group_del($group_id);
        if ($group_delete)
        {
            echo 1;
        } else {
                echo 0;
            }
        }
    /**
     * 渲染粉丝列表试图
     */
    public function actionFans_list()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('fans_list',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染vip个人中心入口试图
     */
    public function actionVip_index()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('vip_index',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /**
     * 渲染vip会员视图
     * @return string|\yii\web\Response
     * @author：zyj
     */
    public function actionVip_user()
    {
        //取出当前登录用户id
        $user = Yii::$app->session->get('user');
        if (!$user){
            return $this->redirect(['user/login']);
        }

        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //xss 安全验证
            $xss = [$post['time1'],$post['time2'],$post['user'],$post['groupid']];
            if ($this->actionXss($xss) == 109){
                return $this->redirect(['make/vip_user']);
            }
            //time 条件
            if ($post['time2'] > $post['time1'] && $post['time1'] != '' && $post['time2'] != ''){
                $w_time = "re_time BETWEEN '{$post['time1']}' and '{$post['time2']}'";
            } else {
                return $this->redirect(['make/vip_user']);
            }
            //user 条件
            if ($post['user'] != ''){
                switch(true)
                {
                    case preg_match("/^1[34578]{1}\d{9}$/",$post['user']):
                        $w_user = "mobile";
                        break;
                    case preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i",$post['user']):
                        $w_user = "email";
                        break;
                    default:
                        $w_user = "realname";
                }
            } else {
                $w_user = '';
            }
            //取出当前登录用户id
            $user = Yii::$app->session->get('user');
            if (!$user){
                return $this->redirect(['user/login']);
            }
            //查询所有会员组
            $vipModel = new WcVip();
            $groups = $vipModel->vip_group_sel($user['id']);
            //查询所有会员
            $vipUserModel = new WcVipUser();
            $groupUser = $vipUserModel->vip_user_sels($user['id'],$w_time,$post['groupid'],$w_user,$post['user']);
            foreach ($groupUser as $k => $v){
                foreach($groups as $key => $val){
                    if ($groupUser[$k]['groupid'] == $groups[$key]['id']){
                        $groupUser[$k]['title'] = $groups[$key]['title'];
                    }
                }
            }
            //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
            $title = '微站设置/站点设置';
            //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
            $keywords = 'wechat demo';
            //title of webpage,you can find title in /web/pub/top.php  eg:''
            $description = '';
            return $this -> render('vip_user',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'groups'=>$groups,
                'groupUser'=>$groupUser,
            ]);
        } else {
            //查询所有会员组
            $vipModel = new WcVip();
            $groups = $vipModel->vip_group_sel($user['id']);
            //查询所有会员
            $vipUserModel = new WcVipUser();
            $groupUser = $vipUserModel->vip_user_sel($user['id']);
            foreach ($groupUser as $k => $v){
                foreach ($groups as $key => $val){
                    if ($groupUser[$k]['groupid'] == $groups[$key]['id']){
                        $groupUser[$k]['title'] = $groups[$key]['title'];
                    }
                }
            }
            //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
            $title = '微站设置/站点设置';
            //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
            $keywords = 'wechat demo';
            //title of webpage,you can find title in /web/pub/top.php  eg:''
            $description = '';
            return $this -> render('vip_user',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'groups'=>$groups,
                'groupUser'=>$groupUser,
            ]);
        }
    }

    /**
     *渲染会员添加试图
     */
    public function actionVip_user_add()
    {
        $post = yii::$app->request->post();
        //xss 安全验证
        unset($post['_csrf']);
        if ($this->actionXss($post) == 109){
            return $this->redirect(['public/message', '您未通过安全验证', '?r=make/vip_user', '3']);
        }
        //信息验证
        //手机号
        if (!preg_match('/^1[34578]{1}\d{9}$/', $post['mobile']) || $post['mobile'] == ''){
            return $this->redirect(['public/message', '手机号不合格', '?r=make/vip_user', '3']);
        }
        //用户名
        if (mb_strlen($post['realname']) > 4 || $post['realname'] == '' ){
            return $this->redirect(['public/message', '用户名不合格', '?r=make/vip_user', '3']);
        }
        //email
        if (!preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i', $post['email']) || $post['email'] == ''){
            return $this->redirect(['public/message', '邮箱不合格', '?r=make/vip_user', '3']);
        }
        //密码
        if (mb_strlen($post['password']) <= 6 || $post['password'] == '' || $post['pwd'] == '' ||  $post['password'] != $post['pwd']){
            return $this->redirect(['public/message', '密码不合格', '?r=make/vip_user', '3']);
        }
        unset($post['pwd']);
        //实例化加密类
        $encrypt = new Ectype();
        //密码进行加密
        $post['password'] = $encrypt->md8($post['password']);
        //执行添加
        $vipUserModel = new WcVipUser();
        $post['vip_id'] = Yii::$app->session->get('user')['id'];
        $post['re_time'] = date('Y-m-d', time());
        $res = $vipUserModel->add($post);
        if ($res){
            return $this->redirect(['public/message','添加成功','?r=make/vip_user','3']);
        } else {
            return $this->redirect(['public/message','添加失败','?r=make/vip_user','3']);
        }
    }

    /**
     * 会员信息编辑
     * @return string
     * @author：zyj
     */
    public function actionVip_value()
    {
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //xss 安全验证
            unset($post['_csrf']);
            if ($this->actionXss($post) == 109){
                return $this->redirect(['public/message', '您未通过安全验证', '?r=make/vip_user', '3']);
            }
            //信息验证
            //手机号
            if (!preg_match('/^1[34578]{1}\d{9}$/', $post['mobile'])){
                return $this->redirect(['public/message', '手机号不合格', '?r=make/vip_user', '3']);
            }
            //用户名
            if (mb_strlen($post['realname']) > 4 ){
                return $this->redirect(['public/message', '用户名不合格', '?r=make/vip_user', '3']);
            }
            //email
            if (!preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i',$post['email'])){
                return $this->redirect(['public/message','邮箱不合格','?r=make/vip_user','3']);
            }
            //密码
            if ($post['password'] != '' && mb_strlen($post['password']) < 6 ||  $post['password'] != $post['pwd']){
                return $this->redirect(['public/message', '密码不合格', '?r=make/vip_user', '3']);
            }
            unset($post['pwd']);
            $encrypt = new Ectype();
            //密码进行加密
            if ($post['password'] == ''){
                unset($post['password']);
            } else {
                $post['password'] = $encrypt->md8($post['password']);
            }
            //执行修改
            $vipUserModel = new WcVipUser();
            $res = $vipUserModel->change($post['id'], $post);
            if ($res){
                return $this->redirect(['public/message', '修改成功', '?r=make/vip_user', '3']);
            } else {
                return $this->redirect(['public/message', '修改失败', '?r=make/vip_user', '3']);
            }
        } else {
            $hid = Yii::$app->request->get('hid');
            $user = Yii::$app->session->get('user');
            $uid = $user['id'];
            $userModel = new WcVipUser();
            $user = $userModel->sel($uid, $hid);
            unset($user['password']);
            $configmodel = new WcVipConfig();
            $config = $configmodel->config($uid);
            $valueModel = new WcVipValue();
            $value = $valueModel->value($uid, $hid);
            foreach ($config as $k => $v){
                foreach ($value as $key => $val){
                    if ($v['id'] == $val['cid']){
                        $config[$k]['word'] = $value[$key]['word'];
                    }
                }
            }
            foreach ($config as $k => $v){
                if (!isset($v['word'])){
                    $config[$k]['word'] = '';
                }
            }
            //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
            $title = '微站设置/站点设置';
            //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
            $keywords = 'wechat demo';
            //title of webpage,you can find title in /web/pub/top.php  eg:''
            $description = '';
            return $this -> render('vip_value',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'user'=>$user,
                'config'=>$config,
                'hid'=>$hid,
            ]);
        }
    }

    /**
     * 会员信息编辑
     * @return \yii\web\Response
     * @author：zyj
     */
    public function actionVip_value_add()
    {
        $post = Yii::$app->request->post();
        $user = Yii::$app->session->get('user');
        $valueModel = new WcVipValue();
        $value = $valueModel->value($user['id'], $post['hid']);
        unset($post['_csrf']);
        foreach ($post as $k => $v){
            if ($v == ''){
                unset($post[$k]);
            }
        }
        $data = [];
        $hid = $post['hid'];
        unset($post['hid']);
        foreach ($value as $k => $v){
            foreach ($post as $key => $val){
                if ($value[$k]['cid'] == $key){
                    //取出 修改
                    $data[$value[$k]['id']] = $post[$key];
                    unset($post[$key]);
                }
            }
        }
        $array = [];
        foreach ($post as $k => $v){
            $array[$k]['hid'] = $hid;
            $array[$k]['uid'] = $user['id'];
            $array[$k]['cid'] = $k;
            $array[$k]['word'] = $post[$k];
        }
        $arr = [];
        foreach ($data as $k => $v){
            $arr[$k]['id'] = $k;
            $arr[$k]['word'] = $data[$k];
        }
        foreach ($arr as $k => $v){
            $valueModel->change($arr[$k]['id'], $arr[$k]);
        };
        foreach ($array as $k => $v){
            $valueModel->add($array[$k]);
        }
        return $this->redirect(['make/vip_user']);
    }

    /**
     *渲染会员列表试图
     */
    public function actionVip_user_list()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('vip_list',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /**
     * @return string
     * @author：zyj
     */
    public function actionVip_user_up()
    {
        $post = Yii::$app->request->post();
        unset($post['_csrf']);
        $vipUserModel = new WcVipUser();
        $res = $vipUserModel->change($post['id'], $post);
        if ($res){
            return json_encode(100);
        } else {
            return json_encode(101);
        }
    }

    /**
     * 会员积分，余额修改
     * @return string
     * @author：zyj
     */
    public function actionVip_user_change()
    {
        $post = Yii::$app->request->post();
        if (substr( $post['credit'], 0, 1 ) == '-'){
            $post['credit'] = $post['cre'] - abs($post['credit']);
        } else {
            $post['credit'] = $post['cre'] + abs($post['credit']);
        }
        if ($post['type'] == 0){
            $where = 'credit1';
        } else {
            $where = 'credit2';
        }
        $data[$where] = $post['credit'];
        $vipUserModel = new WcVipUser();
        $res = $vipUserModel->change($post['id'], $data);
        if ($res){
            return json_encode(100);
        } else {
            return json_encode(101);
        }
    }

    public function actionVip_user_del()
    {
        $u = Yii::$app->request->post('u');
        $vipUserModel = new WcVipUser();
        $res = $vipUserModel->del_s($u);
        if ($res){
            return 100;
        } else {
            return 101;
        }
    }

    /**
     * 会员组
     * @return string|\yii\web\Response
     * @author：zyj
     */
    public function actionVip_group_list()
    {
        //实例化模型层
        $vipModel = new  WcVip();
        //判断是否是post数据
        if (yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $user = Yii::$app->session->get('user');
            //修改状态值 节省数据库资源 此配置使用日志文件实现
            if (file_exists('./log/group.txt')) {
                $file = file_get_contents('./log/group.txt');
                $arr = explode('||', $file);
                array_pop($arr);
                $data = [];
                foreach ($arr as $k => $v) {
                    $arr[$k] = explode(':', $v);
                    $data[$arr[$k][0]] = $arr[$k][1];
                }
                $data[$user['id']] = $post['grouplevel'];
                foreach ($data as $k => $v) {
                    $data[$k] = $k . ':' . $v;
                }
                $str = implode('||', $data) . '||';
                file_put_contents('./log/group.txt', $str);
            } else {
                $data[$user['id']] = 0;
                $str = $user['id'] . ':' . implode('.', $data) . '||';
                file_put_contents('./log/group.txt', $str);
            }
            //数值修改
            unset($post['grouplevel']);
            unset($post['_csrf']);
            $data = [];
            foreach ($post['id'] as $k => $v)
            {
                $data[$post['id'][$k]]['id'] = $post['id'][$k];
                $data[$post['id'][$k]]['title'] = $post['title'][$k];
                $data[$post['id'][$k]]['credit'] = $post['credit'][$k];
            }
            foreach ($data as $k => $v)
            {
                $vipModel->up($v);
            }
            return $this->redirect(['public/message', '修改成功', '?r=make/vip_group_list', '3']);
        } else {
            $user = Yii::$app->session->get('user');
            //读取配置信息
            if (file_exists('./log/group.txt')) {
                $file = file_get_contents('./log/group.txt');
                $arr = explode('||', $file);
                array_pop($arr);
                $data = [];
                foreach ($arr as $k => $v) {
                    $arr[$k] = explode(':', $v);
                    $data[$arr[$k][0]] = $arr[$k][1];
                }
                if (!array_key_exists($user['id'], $data)){
                    $data[$user['id']] = 1;
                }
            } else {
                $data[$user['id']] = 1;
            }
            //调用模型层查询会员组信息的方法
            $group_data = $vipModel->vip_group_sel($user['id']);
            //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
            $title = '微站设置/站点设置';
            //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
            $keywords = 'wechat demo';
            //title of webpage,you can find title in /web/pub/top.php  eg:''
            $description = '';
            return $this->render('vip_group_list', [
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'group_data' => $group_data,
                'check'=>$data[$user['id']],
            ]);
        }
    }

    /**
     * 渲染会员组添加试图
     * @return string|\yii\web\Response
     * @author zyj
     */
    public function actionVip_group_add()
    {
        $post = Yii::$app->request->post();
        $user = Yii::$app->session->get('user');
        unset($post['_csrf']);
        //xss 安全验证
        if ($this->actionXss($post) == 109){
            return $this->redirect(['public/message', '您未通过安全验证', '?r=make/vip_group_list', '3']);
        }
        //字符串验证
        if (mb_strlen($post['title']) > 6 || $post['title'] == '' ){
            return $this->redirect(['public/message', '组名称不合格，需小于等于6位', '?r=make/vip_group_list', '3']);
        }
        //积分验证
        if (!is_numeric($post['credit'])){
            return $this->redirect(['public/message', '请输入正确的积分', '?r=make/vip_group_list', '3']);
        }
        $post['num'] = 2;
        $post['vip_id'] = intval($user['id']);
        //实例化模型层
        $model = new  WcVip();
        //调用模型层添加会员分   组的方法
        if ($model->vip_group_add($post))
        {
            return $this->redirect(['public/message', '添加成功', '?r=make/vip_group_list', '3']);
        } else {
            return $this->redirect(['public/message', '添加失败', '?r=make/vip_group_list', '3']);
        }
    }

    /**
     * 会员组删除
     * @return \yii\web\Response
     */
    public function actionVip_group_del()
    {
        $id = Yii::$app->request->get('id');
        $vipModel = new  WcVip();
        $vipModel->del($id);
        return $this->redirect(['make/vip_group_list']);
    }

    /**
     * 渲染会员积分管理
     * @return string|\yii\web\Response
     * @author：zyj
     */
    public function actionVip_points()
    {
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //xss 安全验证
            $xss = [$post['keyword'], $post['minimal'], $post['maximal']];
            if ($this->actionXss($xss) == 109){
                return $this->redirect(['public/message','您未通过安全验证','?r=make/vip_points','3']);
            }
            //输入信息验证
            $vipUserModel = new WcVipUser();
            if ($post['minimal'] == '' || !is_numeric($post['minimal'])){
                $min = '0';
            } else {
                $min = $post['minimal'];
            }
            if ($post['maximal'] == '' || !is_numeric($post['maximal'])){
                $max = '10000';
            } else {
                $max = $post['maximal'];
            }
            $data = $vipUserModel->points($post['user'], $post['keyword'], $min, $max);
            $title = '微站设置/站点设置';
            $keywords = 'wechat demo';
            $description = '';
            return $this -> render('vip_points',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'data'=>$data,
            ]);
        } else {
            //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
            $title = '微站设置/站点设置';
            //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
            $keywords = 'wechat demo';
            //title of webpage,you can find title in /web/pub/top.php  eg:''
            $description = '';
            return $this -> render('vip_points',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
            ]);
        }
    }

    /**
     * 会员积分 编辑
     * @return string
     * @author：zyj
     */
    public function actionVip_points_change()
    {
        $post = Yii::$app->request->post();
        unset($post['_csrf']);
        if ($this->actionXss($post) == 109){
            return json_encode(109);
        }
        if (substr( $post['credit'], 0, 1 ) == '-'){
            $post['credit'] = $post['cre'] - abs($post['credit']);
        } else {
            $post['credit'] = $post['cre'] + abs($post['credit']);
        }
        $vipUserModel = new WcVipUser();
        $data = ['credit1'=>$post['credit']];
        $res = $vipUserModel->change($post['id'],$data);
        if ($res){
            return json_encode(100);
        } else {
            return json_encode(101);
        }
    }

    /**
     * 渲染会员字段管理
     */
    public function actionVip_status()
    {
        $vipConfigModel =  new WcVipConfig();
        $user = Yii::$app->session->get('user');
        $config = $vipConfigModel->status($user['id']);
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('vip_status',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
            'config'=>$config,
        ]);
    }

    /**
     * 会员字段 编辑
     * @return string|\yii\web\Response
     * @author：zyj
     */
    public function actionVip_status_change()
    {
        $vipConfigModel = new WcVipConfig();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            unset($post['_csrf']);
            if ($this->actionXss($post) == 109){
                return $this->redirect(['public/message', '您未通过安全验证', '?r=make/vip_status', '3']);
            }
            $res = $vipConfigModel->change($post);
            if ($res){
                return $this->redirect(['public/message', '修改成功', '?r=make/vip_status', '3']);
            } else {
                return $this->redirect(['public/message', '修改失败', '?r=make/vip_status', '3']);
            }
        } else {
            $id = Yii::$app->request->get('id');
            $data = $vipConfigModel->sel($id);
            //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
            $title = '微站设置/站点设置';
            //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
            $keywords = 'wechat demo';
            //title of webpage,you can find title in /web/pub/top.php  eg:''
            $description = '';
            return $this -> render('vip_status_change',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'data'=>$data,
            ]);
        }
    }

    /**
     * 会员字段 添加
     * @return \yii\web\Response
     * @author：zyj
     */
    public function actionVip_status_add()
    {
        $post = Yii::$app->request->post();
        unset($post['_csrf']);
        if ($this->actionXss($post) == 109){
            return $this->redirect(['public/message', '您未通过安全验证', '?r=make/vip_status', '3']);
        }
        if (!is_numeric($post['sort'])){
            $post['sort'] = 0;
        }
        if (preg_match('/[\x{4e00}-\x{9fa5}]/u', $post['field'])>0){
            return $this->redirect(['public/message','字段中不可包含中文','?r=make/vip_status','3']);
        }
        $vipConfigModel = new WcVipConfig();
        $user = Yii::$app->session->get('user');
        $post['uid'] = $user['id'];
        $res = $vipConfigModel->add($post);
        if ($res){
            return $this->redirect(['public/message','添加成功','?r=make/vip_status','3']);
        } else {
            return $this->redirect(['public/message','添加失败','?r=make/vip_status','3']);
        }
    }

    /**
     * vip 字段管理-删除
     * @return \yii\web\Response
     */
    public function actionVip_status_del()
    {
        $id = Yii::$app->request->get('id');
        $vipConfigModel = new WcVipConfig();
        $vipConfigModel->del($id);
        return $this->redirect(['make/vip_status']);
    }

    /**
     * 渲染会员微信通知
     */
    public function actionVip_notice()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('vip_notice',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /**
     * 渲染会员交易
     */
    public function actionVip_deal()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('vip_deal',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /**
     * @return string
     * @author：zyj
     */
    public function actionVip_deta()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('vip_deta',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /**
     * 渲染通知中心下的群发消息通知试图
     */
    public function actionNotice_msg()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('notice_msg',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /**
     * 渲染通知中心下的微信素材群发试图
     */
    public function actionWechat_matter()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('wechat_matter',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染微信素材群发下的发送记录试图
     */
    public function actionSend()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('send',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染微信素材群发下的图片试图
     */
    public function actionImage()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('image',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染微信素材群发下的语言试图
     */
    public function actionVoice()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
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
    /**
     * 渲染微信素材群发下的s视频录试图
     */
    public function actionVideo()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
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
    /**
     * 渲染微信素材群发下的图文试图
     */
    public function actionNews()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
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
}
