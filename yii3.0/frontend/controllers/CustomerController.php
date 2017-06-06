<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Customer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\wechatCallbackapiTest;
use yii\filters\VerbFilter;

/**
 * @brief 客服管理控制器
 * @author yuMingLei
 * @email  yuMingLei@cn331.com
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends PublicController
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Customer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @param integer $wechat_id
     * @param integer $kf_id
     * @return mixed
     */
    public function actionView($id, $wechat_id, $kf_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $wechat_id, $kf_id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'wechat_id' => $model->wechat_id, 'kf_id' => $model->kf_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $wechat_id
     * @param integer $kf_id
     * @return mixed
     */
    public function actionUpdate($id, $wechat_id, $kf_id)
    {
        $model = $this->findModel($id, $wechat_id, $kf_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'wechat_id' => $model->wechat_id, 'kf_id' => $model->kf_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $wechat_id
     * @param integer $kf_id
     * @return mixed
     */
    public function actionDelete($id, $wechat_id, $kf_id)
    {
        $this->findModel($id, $wechat_id, $kf_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $wechat_id
     * @param integer $kf_id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $wechat_id, $kf_id)
    {
        if (($model = Customer::findOne(['id' => $id, 'wechat_id' => $wechat_id, 'kf_id' => $kf_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
    *show the page of custommer service
    */
    public function actionCustomer()
    {
        $tab = Yii::$app->request->get('tab') ? Yii::$app->request->get('tab') : '1';
        $title = '多客服管理';
        $keywords = 'wechat customer service 微信 客服';
        $description = '多客服管理';
        
        switch ($tab) 
        {
            case 1:
                $page = 'customer';
                break;
            case 2:
                $page = 'customer1';
                break;
            case 3:
                $page = 'customer2';
                break;
        }
        return $this -> render($page,[
            'tab' => $tab,
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description
        ]);
    }

    /**
    author : yuminglei 
    email  : yuminglei12@cn331.com
    datetime : 5-16 10:16
    function : check datas in the table wc_customer of database which kf_account includes 'keywords'
    */
    public function actionFind_customer()
    {
        $keyword = Yii::$app->request->get('tab') ? Yii::$app->request->get('tab') : '';

        $model = new Customer();

        $data = $model -> find_customer($keyword);
        if (empty($data))
        {
            $info['code'] = '0';
            $info['msg'] = '无此关键字客服账号信息';
        } else {
            $info['code'] = '1';
            $info['msg']  = '查找到'.count($data).'条符合条件的客服账号信息';
            $info['data'] = $data ;
        }
        return  json_encode($info);
    }
    
}
