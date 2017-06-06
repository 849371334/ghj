<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Permission;

/**
 * @brief 权限组管理控制器
 * @author GuoHuiJie
 * @email  GuoHuiJie@cn331.com
 * PermissionController implements the CRUD actions for Group model.
 */
class PermissionController extends PublicController
{
    public $layout = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    /*  this  is a  add page */
    public  function actionAdd()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('add',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }

    /*add  page is  ku */
    public  function  actionAdd_do()
    {
        $post = yii::$app->request->post();
        $model = new Permission();
        if ($model->add_name($post))
        {
            return $this->redirect(['public/message','添加成功','?r=permission/add','3']);
        } else {
            return $this->redirect(['public/message','添加失败','?r=permission/add','3']);
        }
    }

    /*show array is to page */
    public  function  actionShow()
    {
        $model = new Permission();
        $arr = $model->getAll();
//title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('show',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
            'arr' => $arr,
        ]);
    }

    /*delete id from page */
    public  function actionDelete2()
    {
        $id = intval($_GET['id']);
        $model = new Permission();
        if ($model->del1($id))
        {
            return $this->redirect(['public/message','删除成功,前往列表页面','?r=permission/show','3']);
        } else {
            return $this->redirect(['public/message','删除失败,前往列表页面','?r=permission/show','3']);
        }
    }
}
