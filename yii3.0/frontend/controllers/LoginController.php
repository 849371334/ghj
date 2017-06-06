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
 * @brief 登陆管理控制器
 * @author GuoHuiJie
 * @email  GuoHuiJie@cn331.com
 * PublicController implements the CRUD actions for Group model.
 */


//定义常量
define('success',1);//成功
define('danger',2); //危险


class LoginController  extends Controller
{

    public $defaultAction = 'login';
    //去掉公共样式
    public $layout = false;

    /**
     * show login page
     */
    public function actionLogin()
    {
        return $this->render('login');
    }

    /**
     *  登录模块
     * @return bool|string
     */
    public function actionLogin_do()
    {
        $post = yii::$app->request->post();
        $username=$post['username'];
        //实例化加密类
        $encrypt = new Ectype();
        //登陆密码进行加密
        $encrypt_password=$encrypt->md8($post['password']);
        $wcModel= new WcUser();
        $login_test=$wcModel->login_sel($username);
        if (!$login_test)
        {
            return  $this->render('bai');
        } else {
            if($login_test['password']!=$encrypt_password)
            {
                return  $this->render('bai');
            } else {
                //xss攻击验证
                $data = ['username'=>$post['username']];
                if ($this->actionXss($data) == danger){
                    echo "<script>alert('请勿输入危险字符');location.href='?r=user/login'</script>";
                    return false;
                };
                $data['password']=$encrypt->md8($post['password']);
                //用户信息匹配
                switch(true)
                {
                    case preg_match("/^1[34578]{1}\d{9}$/",$data['username']):
                        $where = 'mobile';
                        break;
                    case preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])*(\.([a-z0-9])([-a-z0-9_-])([a-z0-9])+)*$/i",$data['username']):
                        $where = 'email';
                        break;
                    default:
                        $where = 'username';
                }
                $userModel = new WcUser();
                $res = $userModel->login($where, $data['username'], $data['password']);
                if ($res) {
                    //记住账号 把相关信息存入cookie
                    if (isset($post['rember'])){
                        $cookies = Yii::$app->response->cookies;
                        $cookies->add(new \yii\web\Cookie([
                            'name' => 'rember',
                            'value' => $data['username'],
                            //'expire'=>time()+3600*24,
                        ]));
                    }
                    //登陆成功，记录数据
                    $arr['end_ip'] = $_SERVER['REMOTE_ADDR'];
                    $arr['end_time'] = time();
                    $userModel->loginDO($arr, $res['id']);
                    //登陆成功，存入session
                    yii::$app->session['user'] = $res;
                    return  $this->render('success');
                } else {
                    return  $this->render('bai');
                }
            }
        }
    }

    /**
     *  退出模块
     * @return bool
     */
    public function actionLogin_out()
    {
        if (yii::$app->session->remove('user')) {
            return  $this->render('login');
        } else {
            return  $this->render('login');
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
            if (preg_match("/[\':;`%^&)(<>{}]|\]|\[|\/|\\\|\"|\|/",$v)){
                return danger;
            }
        }
        return success;
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
