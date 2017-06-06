<?php
namespace frontend\controllers;

use frontend\models\Rule;
use Yii;
use yii\web\Controller;
use frontend\models\WcUser;
use frontend\models\Permission;
use common\classes\Obj;
use frontend\models\WcUserGroupPermission;


/**
 * @brief Rbac管理控制器
 * @author GuoHuiJie
 * @email  GuoHuiJie@cn331.com
 * PublicController implements the CRUD actions for Group model.
 */

define('BEST_PHPER',serialize(array('admin','admin1')));//设置admin管理员

class PublicController  extends Controller
{

    /*
     * 去掉公共样式
     * */
    public $layout = false;

    /*自动加载*/
    public  function init()
    {
        //获取到cookie值
        $cookie = \Yii::$app->request->cookies;
        $cookie_id = $cookie->getValue('rember');

        //获取到session
        $session = \Yii::$app->session;
        $res = $session->get('user');

        if (isset($cookie_id) && !isset($res['id']))
        {
               $model = new WcUser();
               if (!$sss = $model->getOne($cookie_id))
               {
                    $this->redirect('index.php?r=login/fan');
               }
             yii::$app->session['user'] = $sss;
             $res = $session->get('user');
        }

        if (!isset($res) || empty($res))
        {
            $this->redirect('index.php?r=login/fan');
        }

        if (!in_array($res['username'],unserialize(BEST_PHPER)))
        {
            //用户信息    $res
            $Rule = new Rule();
            $Obj = new Obj();
            $Permission = new Permission();
            $UserPermission = new WcUserGroupPermission;

            $user = $Rule->getOne($res['id']);

            //二维数组
            $PArray = $UserPermission->getAll($user['gid']);

            //所拥有的方法id   array
            $ids = $Obj->array_culmun($PArray,"pid");

            //所用的方法
            $user_actions = $Permission->getNodes($ids);

            //转换成但字段数组格式
            $user_action = $Obj->array_culmun($user_actions,'action');
            $Cnames = substr($_SERVER['QUERY_STRING'], 2);
            $Cname = str_replace("%2F","/",$Cnames);

            if (!in_array($Cname,$user_action))
            {
                $this->redirect(array('/login/node'));
            }
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
                return 109;
            }
        }
        return 100;
    }

    /**
     * 信息回复模版
     * @return string
     * @author zyj
     */
    public function actionMessage()
    {
        $get = Yii::$app->request->get();
        return $this->render('message',[
            'str'=>$get[1],
            'url'=>$get[2],
            'time'=>$get[3],
        ]);
    }
}
