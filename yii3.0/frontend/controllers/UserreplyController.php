<?php

namespace frontend\controllers;

use Yii;
use frontend\models\WcMedia;
use frontend\models\WcMedid;

/**
 * @brief 用户回复管理控制器
 * @author wangbaisen
 * @email  wangbaisen@cn331.com
 * UserreplyController implements the CRUD actions for Customer model.
 */


class UserreplyController extends PublicController
{
    public $enableCsrfValidation = false;

    //根据用户关键字，找到对用内容
    //图文回复
   public function actionNews($type,$user_id)
   {
       if ($type)
       {
            $WcMedid = new WcMedid();
            $Data = $WcMedid->findId($user_id, $type);
            if ($Data)
            {
               $WcMedia = new WcMedia();
               $WcMediaDatac = $WcMedia->selectId($Data['id']);
               $news=array(
                    'digest' => $WcMediaDatac['digest'],
                    'file' => $WcMediaDatac['file'],
                );
                 return $news;
            } else {
                 return "内容不存在";
            }
       }
   }

    //音乐回复
    public function actionImg($type,$user_id)
    {
        if ($type)
        {
            $WcMedid = new WcMedid();
            $Data = $WcMedid->findId($user_id, $type);
            if ($Data)
            {  //具体信息
                $WcMedia = new WcMedia();
                $WcMediaDatac= $WcMedia->selectId($Data['id']);
                $img=array(
                    'file_name'=>$WcMediaDatac['file_name'],
                );
                return $img;
            } else {
                return "内容不存在";
            }
        }
    }

    //语音回复
    public function actionVoice($type,$user_id)
    {
        if ($type)
        {
            $WcMedid = new WcMedid();
            $Data = $WcMedid->findId($user_id, $type);
            if ($Data)
            {  //具体信息
                $WcMedia = new WcMedia();
                $WcMediaDatac = $WcMedia->selectId($Data['id']);
                $voice = array(
                    'file_name' => $WcMediaDatac['file_name'],
                );
                return $voice;
            } else {
                return "内容不存在";
            }
        }
    }

    //视频回复
    public function actionVideo($type,$user_id)
    {
        if ($type)
        {
            $WcMedid = new WcMedid();
            $Data = $WcMedid->findId($user_id, $type);
            if ($Data)
            {  //具体信息
                $WcMedia = new WcMedia();
                $WcMediaDatac = $WcMedia->selectId($Data['id']);
                $video = array(
                    'title' => $WcMediaDatac['title'],
                    'file_name' => $WcMediaDatac['file_name'],
                );
                return $video;
            } else {
                return "内容不存在";
            }
        }
    }
}
