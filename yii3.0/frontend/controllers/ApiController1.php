<?php
namespace frontend\controllers;

use frontend\models\WcAccount;
use yii\web\Wechat;


/**
 * @brief 接口api控制器
 * @author  微信小组开发
 * ApiController implements the CRUD actions for Account model.
 */
class ApiController extends PublicController
{
	public function actionIndex($id)
	{
		if (isset($id))
		{
			$model = new WcAccount();
            return $model->find()
			    ->where(['id' => $id])
			    ->asArray()
			    ->all();
        }
	}

	public function actionTextinfo() 
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : " ";
        if (isset($id))
        {
	        $model = new WcAccount();
			$result = $model->find()
			    ->select(['config_token', 'encodingaeskey', 'appid', 'appsecret'])
			    ->where(['id' => $id])
			    ->asArray()
			    ->all();
	    if ($result == null) {
	            return '微信公众号不存在！';
	        } else {
	            $options = array( 
	               'token' => $result[0]['config_token'] , //填写你设定的key
	               'encodingaeskey' => $result[0]['encodingaeskey'], //填写加密用的EncodingAESKey
	               'appid' => $result[0]['appid'], //填写高级调用功能的app id
	               'appsecret' => $result[0]['appsecret'] //填写高级调用功能的密钥
	            );
	        }
	    }
	    $weObj = new \yii\web\Wechat($options);
	    $weObj->valid();
	    $type = $weObj->getRev()->getRevType();
	    switch ($type) {
	          case Wechat::MSGTYPE_TEXT:
	              $weObj->text("sdfs")->reply();
	              break;
            default:
	              $weObj->text("help info")->reply();
	    }
        //获取菜单操作:
	   $menu = $this->getMenu();
	   //设置菜单
	   $newmenu =  array(
	          "button" =>
	              array(
	                    array('type' => 'click','name' => '最新消息','key' => 'MENU_KEY_NEWS'),
	                    array('type' => 'view','name' => '我要搜索','url' => 'http://www.baidu.com'),
	                  )
	          );
	   $result = $this->createMenu($newmenu);
	 
	        //获取用户发来的信息
	        //$revcon = $this->getRevContent();
	        //$this->text($revcon)->reply();
    }

}
  