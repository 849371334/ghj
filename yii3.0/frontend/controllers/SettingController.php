<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

define('Not_logged',5);//未登录
define('off',0); //关闭
define('on',1);  //开启

/**
 * @brief 基础设置管理控制器
 * @author zhangyingjie
 * @email  zhangyingjie@cn331.com
 * SettingController implements the CRUD actions for Customer model.
 */

class SettingController extends PublicController
{
    public $layout = false;

    /**
     * 基础设置 首页
     * @return string
     */
    public function actionIndex()
    {
        $title = '基础设置/首页';
        $keywords = 'wechat setting';
        $description = '首页';
        return $this->render('index', [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description
        ]);
    }

    /**
     * 基础设置 常用服务接入
     * @return int|mixed|string
     */
    public function actionService()
    {
        if (yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $user = Yii::$app->session->get('user');
            //检测是否登录
            if (!$user) {
                return Not_logged;
            }
            //检测日志文件是否存在
            if (file_exists('./log/service.txt')) {
                $str = file_get_contents('./log/service.txt');
                $arr = explode('||', $str);
                //删除数组最后的空元素
                array_pop($arr);
                $data = [];
                foreach ($arr as $k => $v) {
                    $arr[$k] = explode(':', $v);
                    $data[$arr[$k][0]] = $arr[$k][1];
                }
                if (array_key_exists($user['id'], $data)) {
                    foreach ($data as $k => $v) {
                        $data[$k] = explode(',', $v);
                        array_unshift($data[$k], ' ');
                        unset($data[$k][0]);
                    }
                    //执行状态修改
                    $data[$user['id']][$post['val']] = $post['status'];
                    //转化为字符串 存入日志文件
                    foreach ($data as $k => $v) {
                        $data[$k] = $k . ':' . implode(',', $data[$k]);
                    }
                    $str = implode('||', $data).'||';
                    file_put_contents('./log/service.txt', $str);
                } else {
                    $data[$user['id']]['1'] = off;
                    $data[$user['id']]['2'] = off;
                    $data[$user['id']]['3'] = off;
                    $data[$user['id']]['4'] = off;
                    $data[$user['id']]['5'] = off;
                    $data[$user['id']]['6'] = off;
                    $data[$user['id']][$post['val']] = $post['status'];
                    $data[$user['id']] = implode(',', $data[$user['id']]);
                    //转化为字符串 存入日志文件
                    foreach ($data as $k => $v) {
                        $data[$k] = $k . ':' . $v;
                    }
                    $str = implode('||', $data).'||';
                    file_put_contents('./log/service.txt', $str);
                }
            } else {
                $data[$user['id']]['1'] = off;
                $data[$user['id']]['2'] = off;
                $data[$user['id']]['3'] = off;
                $data[$user['id']]['4'] = off;
                $data[$user['id']]['5'] = off;
                $data[$user['id']]['6'] = off;
                $data[$user['id']][$post['val']] = $post['status'];
                foreach ($data as $k => $v) {
                    $data[$k] = implode(',', $data[$k]);
                }
                $str = $user['id'] . ':' . implode('.', $data) . '||';
                file_put_contents('./log/service.txt', $str);
            }
            return true;
        } else {
            $title = '基础设置/常用功能接入';
            $keywords = 'wechat setting';
            $description = '常用功能接入';
            //取出相关常用服务接入信息
            $user = Yii::$app->session->get('user');

            //begin
            if (file_exists('./log/service.txt')) {
                $str = file_get_contents('./log/service.txt');
                $arr = explode('||', $str);
                //删除数组最后的空元素
                array_pop($arr);
                $data = [];
                foreach ($arr as $k => $v) {
                    $arr[$k] = explode(':', $v);
                    $data[$arr[$k][0]] = $arr[$k][1];
                }
                if (array_key_exists($user['id'], $data)) {
                    foreach ($data as $k => $v) {
                        $data[$k] = explode(',', $v);
                        array_unshift($data[$k], ' ');
                        unset($data[$k][0]);
                    }
                } else {
                    $data[$user['id']]['1'] = off;
                    $data[$user['id']]['2'] = off;
                    $data[$user['id']]['3'] = off;
                    $data[$user['id']]['4'] = off;
                    $data[$user['id']]['5'] = off;
                    $data[$user['id']]['6'] = off;
                }
            } else {
                $data[$user['id']]['1'] = off;
                $data[$user['id']]['2'] = off;
                $data[$user['id']]['3'] = off;
                $data[$user['id']]['4'] = off;
                $data[$user['id']]['5'] = off;
                $data[$user['id']]['6'] = off;
            }
             //end
            return $this->render('service', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description,
                'data'=>$data[$user['id']],
            ]);
        }
    }

    /**
     * 天气服务接口调用例
     * @return string
     */
    public function actionWeather()
    {
        $address = '北京';
        $interfaces = new \yii\web\Interfaces();
        $weather = $interfaces->weather($address);//json格式 需转义
        return $weather;
    }

    /**
     * 翻译服务接口调用例
     * @return bool|string
     */
    public function actionTranslate()
    {
        $word = '没问题';
        $interfaces = new \yii\web\Interfaces();
        $words = $interfaces->translate($word);//json格式 需转义
        return $words;
    }

    /**
     * 老黄历接口例
     * @return bool|string
     */
    public function actionCalendar()
    {
        $date = date('Ymd', time());//必须为yyyyMMdd格式日期 例：20150423
        $interfaces = new \yii\web\Interfaces();
        $date = $interfaces->calendar($date);//json格式 需转义
        return $date;
    }

    /**
     * 新闻接口例
     * @return bool|string
     */
    public function actionNews()
    {
        $interfaces = new \yii\web\Interfaces();
        $news = $interfaces->news();//json格式 需转义
        return $news;
    }

    /**
     * 快递接口例
     * @return bool|string
     */
    public function actionExpress()
    {
        //$company = 'YTO';//快递公司编码不能为中文
        //$numbers = '12345678';//单号
        $company = '中通';//快递公司编码不能为中文
        $numbers = '437251635537';//单号
        switch ($company)
        {
            case '申通':
                $company = 'STO';
                break;
            case '圆通':
                $company = 'YTO';
                break;
            case '中通':
                $company = 'ZTO';
                break;
            case '韵达':
                $company = 'YUNDA';
                break;
            case '顺丰':
                $company = 'SF';
                break;
            case '邮政':
                $company = 'EMS';
                break;
            case '优速':
                $company = 'UC';
                break;
            case '天天':
                $company = 'TTK';
                break;
            default:
        }
        $interfaces = new \yii\web\Interfaces();
        $express = $interfaces->express($company,$numbers);//json格式 需转义
        return $express;
    }
}