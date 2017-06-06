<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Qrcode;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Permission;

/**
 * @brief 二维码管理控制器
 * @author yuMingLei
 * @email  yuMingLei@cn331.com
 * QrcodeController implements the CRUD actions for Customer model.
 */
class QrcodeController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = false;
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
     * Lists all Qrcode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Qrcode::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Qrcode model.
     * @param integer $id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $user_id),
        ]);
    }

    /**
     * Creates a new Qrcode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Qrcode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Qrcode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($id, $user_id)
    {
        $model = $this->findModel($id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Qrcode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($id, $user_id)
    {
        $this->findModel($id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Qrcode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $user_id
     * @return Qrcode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id)
    {
        if (($model = Qrcode::findOne(['id' => $id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return access_token
     * 这个返回参数本应该从缓存中获取，鉴于登录模块没有生生缓存改为动态获取
     * 后期修改时，应该改为从缓存中获取
     */
    public function actionGettoken()
    { 
        $appid='wxcd80607e02d6cb63';
        $appsecret='25f6f7e450ebb52f7d0b4d30b792f175';
        return json_decode(file_get_contents($url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret"))->access_token;
    }
    /**
    *show the page of QRcode page
    */
    public function actionQrcode()
    {
        $tab = Yii::$app->request->get('tab') ? Yii::$app->request->get('tab') : '1';
        $title = '二维码管理';
        $keywords = 'qrcodes 二维码 管理';
        $description = '二维码管理';

        switch ($tab) 
        {
            case 1:
                $page = 'qrcode';
                break;
            case 2:
                $page = 'qrcode1';
                break;
            case 3:
                $page = 'qrcode2';
                break;
        }
        return $this -> render($page,[
            'tab' => $tab,
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description
        ]);
    }

    /*获取换二维码的ticket*/ 
    public function https_post($url,$data=null) 
    { 
        $curl=curl_init(); 
        curl_setopt($curl,CURLOPT_URL,$url); 
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE); 
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE); 
        if(!empty($data)) 
        {
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $output=curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /**
    *to make a qrcode
    *@author yuminglei
    */
    public function actionMkcode(){
        $post = Yii::$app->request->post() ? Yii::$app->request->post() : '';
        if ($post)
        {
            if($post['qrc-model'] == 1)
                {
                       unset($post['scene_str']);
                  } elseif ($post['qrc-model'] == 2)
                    {
                        unset($post['expire']);
                       }
         $token = $this->actionGettoken();
         $time = $post['expire-seconds'];
         $name = $post['scene-name'];
         $keyword = $post['keyword'];
         $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
         $qrcode = '{"expire_seconds":'.$time.', "action_name": "QR_SCENE","action_info": {"scene": {"user_id": "1","name": '.$name.',"keyword": '.$keyword.'}}}';
         $result = $this->https_post($url,$qrcode);
         $jsoninfo = json_decode($result,true);
         $ticket = $jsoninfo['ticket'];
         

        $data = [
            'user_id' => 1,//入库操作,等待合并项目之后,因为字段是非空的,所以用1作为默认值使用session得到
            'scene_id' =>  $name,
            'end_time' => time()+$time,
            'add_time' => time(),
            'scan_num' => 0,
            'wechat_id' => 1,
            'type' => 0,
            'status' => 1,
            'sort' => 1,
            'key_name' => $keyword,
            'scene_name' => $name,
            'qrcode_url' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=',
            'ticket' => $ticket
        ];
        $model = new Qrcode();
        if ($model -> insertdata($data))
        {
            return $this->redirect(['public/message','successfullly create !','?r=qrcode/qrcode&tab=1','3']);
        } else {
            return $this->redirect(['public/message','failed create !','?r=qrcode/qrcode&tab=2','3']);
        }
     }
 }

    //select * from qrcode where keyword = $keyword
    public function actionFind_qrcode(){

        $post = Yii::$app->request->get() ? Yii::$app->request->get() : '';
        $model = new Qrcode();
        // $user_id=1用户IDsession获取，待合并后开发加入where
        $data = $model -> finddata($post['keywords']);
        
        $info = [];
        if (empty($data))
        {
            $info['code']= 0;
            $info['msg']  = 'no datas found !';
        } else {
            $info['code'] = 1;
            foreach($data as $k => $v){
                $data[$k]['add_time'] = date('Y-m-d H:i:s',$data[$k]['add_time']);
                $data[$k]['end_time'] = date('Y-m-d H:i:s',$data[$k]['end_time']);
            }
            $info['data'] = $data;
        }
            
        return json_encode($info);
    }

    /**
    *delete * the useless qrcode
    *@author yuminglei
    */
    public function actionDelcode()
    {
        $user_id = 1;//用户ID session获取，待合并后开发加入where
        $now = time();

        $model = new Qrcode();
        $codes = $model -> findids($user_id,$now);
        foreach ($codes as $k => $v)
        {
            $ids[] = $v['id'];
        }
        if (empty($ids))
        {
            $info['code'] = 0;
            $info['msg']  = 'no useless qrcodes!';
            // break;
        } else {
            $ids = '('.implode(',',$ids).')';

            $bool = $model -> delcodes($ids);

            if ($bool)
            {
                $info['code'] = 1;
                $info['msg']  = 'successed!';
            } else {
                $info['code'] = 2;
                $info['msg']  = 'failed!';
            }
        }
        return  json_encode($info);
    }

    /**
     * @author : yuminglei
     * function :展示生成长连接二维码页面
     * 参数：无
     */
    public function actionLongurl(){
        $title = '长连接二维码';
        $keywords = 'qrcodes 长连接 二维码';
        $description = '长连接二维码';
        return $this -> render('longurl',[
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description
        ]);
    }

    /**
     * @author: yuminglei
     * function:生成短链接以及二维码
     */
    public function actionLong2short(){
        $get = Yii::$app->request->get('longurl') ? Yii::$app->request->get('longurl') : '';
        $data='{"action":"long2short","long_url":"'.$get.'"}';
        $token = $this->actionGettoken();
        $url = $url="https://api.weixin.qq.com/cgi-bin/shorturl?access_token={$token}";
        $shorts = $this->Shoturl($data,$url);
        $short = json_decode($shorts,true);
        if($short['errcode'] != 0)
        {
            $return = [
                'errcode' => 0,
                'errmsg' => $short['errcode']
            ];
        }
        else
        {
            $url1 = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
            $qrcode = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "123","url":"'.$short['short_url'].'"}}}';
            $result = $this->https_post($url1,$qrcode);
            $jsoninfo = json_decode($result,true);
            $ticket = $jsoninfo['ticket'];
            $qrcode_url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
            $return = [
                'errcode' => 1,
                'qrcode' => $qrcode_url,
                'short_url' => $short['short_url']
            ];
        }
        return  json_encode($return);
    }

    /**
     * @author : yuminglei
     * 属性 ：私有
     * function :调用接口，讲长链接转换成短链接
     * 参数：见代码注释
     * 返回（return）:转换后的短链接shorturl
     */
    private function Shoturl($data,$url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0(compatible; MSIE 5.01;Windows NT 5.0)');
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $shorturl = curl_exec($ch);
        if(curl_errno($ch)){
            return curl_error($ch);
        }
        curl_close($ch);
        return $shorturl;
    }

    /**
     * author : yuminglei
     * funtion : 此方法的作用是获取本站页面所有的URL
     * 接收参数：无
     * 返回json格式的URL数据，是从wc_user_permission表中获取的
     */
    public function actionFindurls(){
        $model = new Permission();
        $data = $model -> getAll();
        return  json_encode($data);
    }
}

  
