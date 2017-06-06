<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\WcUserapi;
use frontend\models\WcUserconf;



class PlatformController extends Controller
{
    public $layout = false;

    public function actionIndex()
    {
        $session = yii::$app->session['user'];
        
        $WcUserapi = new WcUserapi();
        $arrayInfo = $WcUserapi->find()
            ->select('keywords,id,reply_rule')
            ->where(['wx_id' => $session['id']])
            ->asArray()
            ->all();
        $title = '自定义接口回复 - 商城系统V1.7';
        $keywords = '商城系统';
        $description = '商城系统';
        return $this->render('index', [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
            'rid' => $session['id'],
            'arrayInfo' => $arrayInfo
        ]);
    }
    //添加自定义回复接口
    public function actionReplyadd()
    {
        $request = yii::$app->request;
        if ($request->ispost) {
            $Userapi = new WcUserapi();
            $rid = $request->post('wx_id');
            $Userapi->reply_rule = $request->post('reply_rule');
            $Userapi->status = $request->post('status');
            $Userapi->istop = $request->post('istop');
            $Userapi->priority = $request->post('priority');
            $Userapi->wx_id = $rid;
            $Userapi->keywords = $request->post('keywords');
            $Userapi->apitype = $request->post('apitype');
            $Userapi->apiurl = $request->post('apiurl');
            $Userapi->wetoken = $request->post('wetoken');
            $Userapi->apilocal = $request->post('apilocal');
            $Userapi->default = $request->post('default');
            $Userapi->cachetime = $request->post('cachetime');
            if ($Userapi->save() > 0) {
                $apiId = $Userapi->attributes['id'];
                return $this->redirect(['public/message','添加成功',"?r=platform/comreply&apid=$apiId",'3']);
            } else {
                return $this->redirect(['public/message','添加失败，请重新填写','?r=platform/replyadd','3']);
            }

        }
        $session = yii::$app->session['user'];
        $title = '自定义接口添加 - 商城系统V1.7';
        $keywords = '商城系统';
        $description = '商城系统';

        $dir=dirname(__FILE__)."/../api/";
        $file=scandir($dir);
        $dir = [];
        foreach ($file as $key => $value)
        {
            if ($key > 1) {
                $dir[$key-1] = $value;
            }
        }
        //通过rid去数据库查找开启的插件
        //获取api文件下的插件方法
        return $this->render('replyadd', [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
            'dir' =>$dir,
            'rid' => $session['id']
            ]);
    }
    public function actionDelete()
    {
        $apid = $_GET['apid'];
        $user = WcUserapi::find()->where(['id'=>$apid])->one(); 
        if ($user->delete()) {
            return $this->redirect(['public/message','数据删除成功',"?r=platform/index",'2']);
        } else {
            return $this->redirect(['public/message','删除失败',"?r=platform/index",'2']);
        }
    }
    //编辑自定义
    public function actionComreply()
    {
        $request = yii::$app->request;
        if ($request->ispost) {
            $info = $request->post();
            // $Userapi = new WcUserapi();
            $rid = $request->post('wx_id');
        
            $Userapi = WcUserapi::find()->where(['id'=>$rid])->one();
            $Userapi->reply_rule = $request->post('reply_rule');
            $Userapi->status = $request->post('status');
            $Userapi->istop = $request->post('istop');
            $Userapi->priority = $request->post('priority');
            $Userapi->keywords = $request->post('keywords');
            $Userapi->apitype = $request->post('apitype');
            $Userapi->apiurl = $request->post('apiurl');
            $Userapi->wetoken = $request->post('wetoken');
            $Userapi->apilocal = $request->post('apilocal');
            $Userapi->default = $request->post('default');
            $Userapi->cachetime = $request->post('cachetime');
            if ($Userapi->save() > 0) {
                $apiId = $Userapi->attributes['id'];
                return $this->redirect(['public/message','修改成功',"?r=platform/comreply&apid=$apiId",'3']);
            } else {
                return $this->redirect(['public/message','修改失败，请重新填写','?r=platform/comreply&apid=$apiId','3']);
            }
        }
        $session = yii::$app->session['user'];
        $apiId = yii::$app->request->get('apid');
        $model = new WcUserapi();
        $info = $model->find()
            ->where(['id'=>$apiId])
            ->asArray()
            ->all();
        // echo "<pre>";
        // var_dump($info[0]);die;
        $title = '自定义接口添加 - 商城系统V1.7';
        $keywords = '商城系统';
        $description = '商城系统';
        $dir=dirname(__FILE__)."/../api/";
        $file=scandir($dir);
        $dir = [];
        foreach ($file as $key => $value)
        {
            if ($key > 1) {
                $dir[$key-1] = $value;
            }
        }
        return $this->render('comreply', [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
            'info' => $info[0],
            'rid' => $session['id'],
            'dir' =>$dir
        ]); 
        
    }
    //系统回复接口
    public function actionSpecial()
    {
        $Userconf = new WcUserconf();
        $request = yii::$app->request;
        if ($request->ispost) {
            $info = $request->post();
            $wx_id = $info['wx_id'];
            //查询是否有信息
            $bool = $Userconf->getOne($wx_id);
            unset($info['submit']);
            unset($info['id']);
            unset($info['_csrf']);
            if (!empty($bool)) {
                $user = $Userconf->find()->where(['wx_id'=>$wx_id])->one(); //获取name等于test的模型
                $user->welcome = $info['welcome'];
                $user->default = $info['default'];
                if ($user->save()) {
                    return $this->redirect(['public/message','修改成功',"?r=platform/special",'2']);
                }  else {
                    return $this->redirect(['public/message','修改失败！',"?r=platform/special",'2']);
                }
                
            } else {
                $res = $Userconf->add($info);
                if ($res ==1 ) {
                    return $this->redirect(['public/message','系统回复添加成功',"?r=platform/special",'2']);
                } else {
                    return $this->redirect(['public/message','系统回复添加-失败',"?r=platform/special",'2']);
                }
            }

        }
        $session = yii::$app->session['user'];
        $info = $Userconf->find()
            ->where(['wx_id'=>$session['id']])
            ->asArray()
            ->all();
        $title = '自定义接口添加 - 商城系统V1.7';
        $keywords = '商城系统';
        $description = '商城系统';
        // echo "<pre>";
        // var_dump($info);die;
        if (!empty($info)) {
            return $this->render('special', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description,
                'welcome' => $info[0]['welcome'],
                'default' => $info[0]['default'],
                'id' => $session['id']
            ]);
        } else {
            return $this->render('special', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description,
                'welcome' => null,
                'default' => null,
                'id' => $session['id']
            ]);
        }
    }

}
