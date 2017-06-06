<?php

namespace frontend\controllers;


use Yii;
use frontend\models\WcMedia;
use frontend\models\WcMedid;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\UploadForm;

/**
 * @brief 回复管理控制器
 * @author wangbaisen
 * @email  wangbaisen@cn331.com
 * ReplyController implements the CRUD actions for Customer model.
 */

class ReplyController extends PublicController
{
    //图片上传入库
    //由于参数所置，下列默认值仅用于测试。
    public function actionUpload()
    {
        $post = yii::$app->request->post();

        if ($post)
        {
            $upload = new UploadedFile(); //实例化上传类
            $name = $upload->getInstanceByName('file'); //获取文件原名称

            $img = $_FILES['file']; //获取上传文件参数

            $upload->tempName = $img['tmp_name']; //设置上传的文件的临时名称

            $img_path = 'uploads/'.$name; //设置上传文件的路径名称(这里的数据进行入库)
            $arr = $upload->saveAs($img_path); //保存文件
            $data = array(
                'sort' =>'0',
                'size' =>'0',
                'is_show' =>'0',
                'type' =>'0',
                'title' =>'0',
                'file_name' =>'0',
                'digest'=>$post['digest'],
                'link' =>'0',
                'file'=>$img_path,
                'name'=>$post['name'],
                'content' =>'0',
            );
            $keyword = $post['keyword'];
            //实例化model
            $wc = new WcMedia();
            if ($wc->add($data))
            {
                $id = Yii::$app->db->getLastInsertId();
                $model = new  WcMedid();
                $a = array(
                    'media_id' => $id,
                    'wechat_id' => '0',//后续更改微信ID
                    'add_time' => '0',
                    'edit_time' => '0',
                    'keyword' => $keyword,
                    'author' => '0',
                    'is_material' => '0',
                    'media_url' => '0',
                );
                if ($model ->add($a))
                {
                    return $this->redirect(['public/message', '添加成功', '?r=user/news', '3']);
                }
            } else {
                    return "失败";
            }
        }
    }

//音乐入库
    //由于参数所置，下列默认值仅用于测试。

    public function actionMusic()
    {
        $post = yii::$app->request->post();
        if ($post)
        {
            $data=array(
                'sort' =>'0',
                'size' =>'0',
                'is_show' =>'0',
                'type' =>'0',
                'title' =>'0',
                'file_name' =>$post['file_name'],
                'digest'=>'0',
                'link' =>'0',
                'file'=>'0',
                'name'=>$post['name'],
                'content' =>'0',
            );
            $keyword = $post['keyword'];
            $we = new WcMedia();
            if ($we->add($data))
            {
                $id = Yii::$app->db->getLastInsertId();
                $model = new  WcMedid();
                $a = array(
                    'media_id' => $id,
                    'wechat_id' => '0',//后续更改微信ID
                    'add_time' => '0',
                    'edit_time' => '0',
                    'keyword' => $keyword,
                    'author' => '0',
                    'is_material' => '0',
                    'media_url' => '0',
                );

                if ($model ->add($a))
                {
                    return $this->redirect(['public/message', '添加成功', '?r=user/img', '3']);
                }
            } else {

                 return  "失败";
        }
        }
    }

    //语音入库
    //由于参数所置，下列默认值仅用于测试。
    public function actionVoice()
    {
        $post = yii::$app->request->post();
//        var_dump($post);die;
        if ($post)
        {
            $data=array(
                'sort' =>'0',
                'size' =>'0',
                'is_show' =>'0',
                'type' =>'0',
                'title' =>'0',
                'file_name' =>$post['file_name'],
                'digest'=>'0',
                'link' =>'0',
                'file'=>'0',
                'name'=>$post['name'],
                'content' =>'0',
            );
            $keyword = $post['keyword'];
            $model = new WcMedia();
            if ($model->add($data))
            {
                $id = Yii::$app->db->getLastInsertId();
                $modell = new  WcMedid();
                $a = array(
                    'media_id' => $id,
                    'wechat_id' => '0',//后续更改微信ID
                    'add_time' => '0',
                    'edit_time' => '0',
                    'keyword' => $keyword,
                    'author' => '0',
                    'is_material' => '0',
                    'media_url' => '0',
                );
                if ($modell ->add($a))
                {
                    return $this->redirect(['public/message', '添加成功', '?r=user/voice', '3']);
                }
            } else {
                return "失败";
            }
        }
    }
    //上传视频
    //由于参数所置，下列默认值仅用于测试。

    public function actionVideo()
    {
        $post = yii::$app->request->post();
//        var_dump($post);die;
        if ($post)
        {
            $data = array(
                'sort' =>'0',
                'size' =>'0',
                'is_show' =>'0',
                'type' =>'0',
                'title' =>$post['title'],
                'file_name' =>$post['file_name'],
                'digest'=>'0',
                'link' =>'0',
                'file'=>'0',
                'name'=>$post['name'],
                'content' =>'0',
            );
            $keyword = $post['keyword'];
            $model = new WcMedia();
            if ($model->add($data))
            {
                $id = Yii::$app->db->getLastInsertId();
                $modell = new  WcMedid();
                $a = array(
                    'media_id' => $id,
                    'wechat_id' => '0',//后续更改微信ID
                    'add_time' => '0',
                    'edit_time' => '0',
                    'keyword' => $keyword,
                    'author' => '0',
                    'is_material' => '0',
                    'media_url' => '0',
                );
                if ($modell ->add($a))
                {
                    return $this->redirect(['public/message', '添加成功', '?r=user/video', '3']);
                }
            } else {
                    return "失败";
            }
        }
    }
}



?>