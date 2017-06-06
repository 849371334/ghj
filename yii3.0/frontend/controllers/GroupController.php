<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Group;
use frontend\models\Limit;
use frontend\models\Permission;
use frontend\models\WcUserGroupPermission;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
* @brief 用户组管理控制器
* @author GuoHuiJie
* @email  GuoHuiJie@cn331.com
* GroupController implements the CRUD actions for Group model.
*/
class GroupController extends PublicController
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
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Group::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Group();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*  this  is a  add page */
    public  function actionAdd()
    {
        $model = new Group();
        $permission = new Permission();
        $node = $permission->getAll();
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('list',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
            'model' => $model,
            'node' => $node,
        ]);
    }

    /**
     *  添加模块
     * @return bool|int
     */
    public function actionAdd_do()
    {
        /*实例化model*/
        $model = new Group();
        $limit = new Limit();
        $node = new WcUserGroupPermission();
        $post = yii::$app->request->post();
        if (!isset($post['pid']))
        {
            return $this->redirect(['public/message','不存在参数','?r=user/node','3']);
        }

        /*
         * @return int(1)
         * 添加用户组数据
         * */
        if ($model->add_name($post))
           {
               $group_id = Yii::$app->db->getLastInsertId();
               /*循环入库用户and权限的子系表*/
               $array = array();
               $arr = array();
               foreach ($post['pid'] as $k => $v)
               {
                   $array[$k]['pid'] = $v;
                   $array[$k]['gid'] = $group_id;
               }
               $node->add_all($array);
               $arr['account_limit'] = $post['account_limit'];
               $arr['group_id'] = $group_id;
               /*入公众号限制表*/
               if ($limit->add_limit($arr))
               {
                  return $this->redirect(['public/message','添加成功','?r=group/show','3']);
               }
           } else {
                  return $this->redirect(['public/message','添加失败','?r=group/add','3']);
                }
            }

    /**
     *  显示模块
     * @return bool|array
     */
    public  function  actionShow()
    {
        /*
         * 实例化model层*/
        $Group = new Group();
        $Limit = new Limit();
        $node = new WcUserGroupPermission();
        /*
         * 得到数值之后进行循环，形成一个新的数组*/
        $GroupData = $Group->getAll();
        $LimitData = $Limit->getAll();
        $array = array();
        foreach ($GroupData as $k => $v)
        {
            foreach ($LimitData as $key => $value)
            {
                if ($v['id']==$value['group_id'])
                {
                    $array[$k]['limit'] = $value['account_limit'];
                }
                    $array[$k]['id'] = $v['id'];
                /*
                 * 得到用户组权限，and show
                 * */
                    $nodeAll = $node -> getAll($v['id']);
                foreach ($nodeAll as $k2 =>$v2)
                {
                       $pid[$k] = $v2['pid'];
                       foreach ($pid as $k3 => $v3)
                       {
                           $Permission = new Permission();
                           $res = $Permission->getNode($v3);
                           if ($res && isset($res[$k]['action'])) {
                               $array[$k]['node'][] = $res[$k]['action'];
                           }
                       }
                 }
                $array[$k]['group_name'] = $v['group_name'];
            }
        }
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
            'arr' => $array,
        ]);
    }

    /*
     * this a delete page
     * @return int
     * */
    public  function  actionDelete2()
    {
        $id = intval($_GET['id']);
        $model = new Group();
        $model2 = new WcUserGroupPermission();
        if ($model->del1($id) && $model2->del1($id))
        {
            $limit = new Limit();
            if ($limit->del1($id))
            {
                return $this->redirect(['public/message','删除成功,前往列表页面','?r=group/show','3']);
            }
        }
    }

    /*
    * this a update page
    * @return array
    * */
    public  function  actionUpdate2()
    {
        $id = intval($_GET['id']);
        $model = new Limit();
        /*return array*/
        $arr = $model->getOne($id);
        if (is_array($arr))
        {
            $title = '微站设置/站点设置';
            $keywords = 'wechat demo';
            $description = '';
            return $this -> render('update2',[
                'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
                'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
                'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
                'arr' => $arr,
            ]);
        } else {
            return $this->redirect(['public/message','主管理员不可删除','?r=group/show','3']);
        }
    }

    /*
     * upadte account_limit  */
    public  function actionUpdate_limit()
    {
        $limit = new Limit();
        $post = yii::$app->request->post();
        $limit->save1($post);
        return $this->redirect(['public/message','修改成功,前往列表页面','?r=group/show','3']);
    }

    /**
     * @inheritdoc  修改用户组权限
     * @params   $add  array 查询数据
     */
    public  function  actionNode()
    {
        $id = intval($_GET['id']);
        $model = new Group();
        $arr = $model->getName($id);
        $permission = new Permission();
        $node = $permission->getAll();
        $title = '微站设置/站点设置';
        $keywords = 'wechat demo';
        $description = '';
        return $this -> render('node',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description,//description of webpage,you can find description in the head of /web/pub/top.php
            'node' => $node,
            'arr' => $arr,
        ]);
    }

    /**
     * @inheritdoc  进行修改用户组权限入库
     * @params   $add  array 查询数据
     */
    public  function  actionNode2()
    {
        $post = yii::$app->request->post();
        $model = new WcUserGroupPermission();
        if ($model->del1($post['group_id']))
        {
            $array = array();
            foreach ($post['pid'] as $k => $v)
            {
                $array[$k]['pid'] = $v;
                $array[$k]['gid'] = $post['group_id'];
            }
            $model->add_all($array);
            return $this->redirect(['public/message','修改成功,前往列表页面','?r=group/show','3']);
        }
    }
}
