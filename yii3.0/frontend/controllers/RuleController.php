<?php

namespace frontend\controllers;

use frontend\models\WcUser;
use Yii;
use yii\web\Controller;
use frontend\models\Group;
use frontend\models\Rule;
use frontend\models\User;

/**
 * @brief 角色管理控制器
 * @author guohuijie
 * @email  guohuijie@cn331.com
 * RuleController implements the CRUD actions for Customer model.
 */

class RuleController extends PublicController
{
    public $layout = false;

    /*给用户分配角色*/
    public  function  actionAdd()
    {
        $model = new Group();
        $arr = $model->getAll();
        $title = '微站设置/站点设置';
        $keywords = 'wechat demo';
        $description = '';
        return $this -> render('add',[
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
            'arr' => $arr,
        ]);
    }

    /*给用户分配角色入数据*/
    public  function  actionAdd_do()
    {
        $post = yii::$app->request->post();
        $role = new Rule();
        if ($role->add_name($post))
        {
            return $this->redirect(['public/message', '添加成功', '?r=rule/show', '3']);
        } else {
            return $this->redirect(['public/message', '添加失败', '?r=rule/add', '3']);
        }
    }

    /*展示数据*/
    public  function  actionShow()
    {
        $user = new WcUser();
        $Group = new Group();
        $Rule = new Rule();
        $userData = $user->getAll();
        $GroupData = $Group->getAll();
        $RuleData = $Rule->getAll();
        $array = array();
        foreach ($userData as $k => $v)
        {
            foreach ($RuleData as $k1 => $v1)
            {
                foreach ($GroupData as $k2 => $v2)
                {
                    if ($v['id']==$v1['uid'])
                    {
                        if ($v2['id']==$v1['gid'])
                        {
                            $array[$k]['group_name'] = $v2['group_name'];
                        }
                        $array[$k]['id'] = $v['id'];
                        $array[$k]['name'] = $v['username'];
                    }
                }
            }
        }
        $title = '微站设置/站点设置';
        $keywords = 'wechat demo';
        $description = '';
        return $this -> render('show',[
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description,
            'arr' => $array,
        ]);
    }

    /*解除用户当前所在用户组*/
    public  function  actionDelete2()
    {
        $id = intval($_GET['id']);
        $model = new Rule();
        if ($model->del1($id))
        {
            return $this->redirect(['public/message', '删除成功,前往列表页面', '?r=rule/show', '3']);
        } else {
            return $this->redirect(['public/message', '删除失败,前往列表页面', '?r=rule/show', '3']);
        }
    }

    /*修改数据*/
    public  function  actionUpdate1()
    {
        $id = intval($_GET['id']);
        $name = $_GET['name'];
        $model = new Group();
        /*return array*/
        $arr=$model->getAll();
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
                'name' => $name,
                'id' => $id,
            ]);
        }
    }

    /*修改入库*/
    public  function  actionUpdate_limit()
    {
        $post = yii::$app->request->post();
        $model = new Rule();
        if ($model->del1($post['uid']))
        {
            if ($model->add_name($post))
            {
                return $this->redirect(['public/message', '修改成功,前往列表页面', '?r=rule/show', '3']);
            } else {
                return $this->redirect(['public/message', '修改失败,前往列表页面', '?r=rule/show', '3']);
            }
        }
    }
}
