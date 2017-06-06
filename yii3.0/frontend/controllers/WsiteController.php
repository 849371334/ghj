<?php

namespace frontend\controllers;


use yii\filters\VerbFilter;

/**
 * @brief 渲染页面
 * @class
 * @author
 * @email
 * WsiteController implements the CRUD actions for Account model.
 */

class WsiteController extends PublicController
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
     * @return string
     * 渲染微站试图
     */
    public function actionTest()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('test',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    
    /**
     * @return string
     * 渲染站点添加试图
     */
    public function actionSite_add()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('site_add',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染站点展示试图
     */
    public function actionSite_list()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('site_list',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染文章管理添加试图
     */
    public function actionArticle_add()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('article_add',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染文章管理列表试图
     */
    public function actionArticle_list()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('article_list',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染分类管理试图
     */
    public function actionCate_add()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('cate_add',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染分类管理列表试图
     */
    public function actionCate_list()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('cate_list',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
    /**
     * 渲染分类管理列表试图
     */
    public function actionMake()
    {
        //title of webpage,you can find title in /web/pub/top.php  eg:first_title/second_title
        $title = '微站设置/站点设置';
        //title of webpage,you can find title in /web/pub/top.php  eg:wechat demo
        $keywords = 'wechat demo';
        //title of webpage,you can find title in /web/pub/top.php  eg:''
        $description = '';
        return $this -> render('make',[
            'title' => $title,//title of webpage,you can find title in the head of /web/pub/top.php
            'keywords' => $keywords,//keywords of webpage,you can find keywords in the head of /web/pub/top.php
            'description' => $description//description of webpage,you can find description in the head of /web/pub/top.php
        ]);
    }
  
    
}
