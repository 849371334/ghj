<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\WcKeyLog;
use frontend\models\WcKeyword;
use frontend\models\WcChatlog;
use frontend\models\WcSystemConfig;

define('TimeFalse',5);//时间错误

/**
 * @brief  微信统计管理控制器
 * @author zhangyingjie
 * @email  zhangyingjie@cn331.com
 * StatisticsController implements the CRUD actions for Customer model.
 */
class StatisticsController extends PublicController
{
    public $layout = false;

    /**
     * 聊天记录
     * @return int|mixed|\Services_JSON|string
     */
    public function actionChatlog()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $user = Yii::$app->session->get('user');
            $chatModel = new WcChatlog();
            $post['timeStart'] = strtotime($post['timeStart']);
            $post['timeEnd'] = strtotime($post['timeEnd']);
            //检测时间格式
            if ($post['timeStart'] > $post['timeEnd']){
                return TimeFalse;
            }
            //xss 及 sql 验证
            if ($this->actionXss($post['keyword']) == 3){
                return 3;
            };
            //先定义公众号id为1  后期应修改为从cookie或session读取
            $public_id = 1;
            $where = "user_id = '{$user['id']}' AND public_id = '$public_id' AND r_time BETWEEN '{$post['timeStart']}' AND '{$post['timeEnd']}' AND record like '%{$post['keyword']}%'";
            $data = $chatModel->search($where);
            foreach ($data as $k => $v){
                $data[$k]['r_time'] = date('Y-m-d',$data[$k]['r_time']);
            }
            return json_encode($data);
        } else {
            $title = '数据统计/聊天记录';
            $keywords = 'wechat chat log';
            $description = '聊天记录';
            return $this->render('chatlog', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description
            ]);
        }
    }

    /**
     * 聊天记录删除
     * @return int
     */
    public function actionChatlogDel()
    {
        $id = Yii::$app->request->post('id');
        $chatModel = new WcChatlog();
        $res = $chatModel->del($id);
        if ($res){
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * 参数
     * @return string
     */
    public function actionParameter()
    {
        $systemModel = new WcSystemConfig();
        //自定义定义公众号id为1  后期应修改为从cookie或session读取
        $public_id = 1;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            //xss 及 sql 验证
            if ($this->actionXss($post['msg_maxday']) == 3){
                echo "<script>alert('非法操作');location.href='?r=statistics/parameter'</script>";
                return false;
            };
            $data['is_record'] = $post['msg_history'];
            $data['rec_time'] = $post['msg_maxday'];
            //执行修改
            $systemModel->up($public_id, $data);
            //根据公众号ID查询相关参数
            $data = $systemModel->search($public_id);
            $title = '数据统计/参数';
            $keywords = 'wechat parameter';
            $description = '参数统计';
            return $this->render('parameter', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description,
                'data' => $data,
            ]);
        } else {
            //根据公众号ID查询相关参数
            $data = $systemModel->search($public_id);
            $title = '数据统计/参数';
            $keywords = 'wechat parameter';
            $description = '参数统计';
            return $this->render('parameter', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description,
                'data' => $data,
            ]);
        }
    }

    /**
     * 关键词命中统计
     * @return mixed|\Services_JSON|string
     */
    public function actionKeywords()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $user = Yii::$app->session->get('user');
            $userId = $user['id'];
            if (isset($post['status'])) {
                $KeyWordsModel = new WcKeyword();
                switch ($post['status']) {
                    case 0:
                        //查询已命中
                        $where = 'num > 0';
                        $data = $KeyWordsModel->search($userId, $where);
                        foreach ($data as $k => $v){
                            $data[$k]['time'] = '请使用时间段查询';
                            $data[$k]['user_id'] = $user['username'];
                        }
                        return json_encode($data);
                        break;
                    case 1:
                        //查询未命中
                        $where = 'num = 0';
                        $data = $KeyWordsModel->search($userId, $where);
                        foreach ($data as $k => $v){
                            $data[$k]['time'] = '请使用时间段查询';
                            $data[$k]['user_id'] = $user['username'];
                        }
                        return json_encode($data);
                        break;
                    default:
                        return true;
                }
            } else {
                //查询固定时间段
                $post['timeStart'] = strtotime($post['timeStart']);
                $post['timeEnd'] = strtotime($post['timeEnd']);
                if($post['timeStart'] > $post['timeEnd']){
                    return TimeFalse;
                }
                $keyLogModel = new WcKeyLog();
                $where = "time BETWEEN {$post['timeStart']} AND {$post['timeEnd']}";
                $data = $keyLogModel->sear($userId,$where);
                foreach ($data as $k => $v){
                    $data[$k]['time'] = date('Y-m-d', $data[$k]['time']);
                    $data[$k]['user_id'] = $user['username'];
                }
                return json_encode($data);
            }
        } else {
            $title = '数据统计/关键词';
            $keywords = 'wechat keywords';
            $description = '关键词命中';
            return $this->render('keywords', [
                'title' => $title,
                'keywords' => $keywords,
                'description' => $description
            ]);
        }
    }

    /**
     * 关键词记录删除
     * @return int
     */
    public function actionKeywordsDel()
    {
        $post = Yii::$app->request->post();
        if ($post['status'] == 0 ){
            $kwordModel = new WcKeyword();
        } else {
            $kwordModel = new WcKeyLog();
        }
        $res = $kwordModel->del($post['id']);
        if ($res){
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * xss 攻击验证
     * @param $xss
     * @return int
     */
    public function actionXss($xss)
    {
        if(preg_match("/[\':;`%^&)(<>{}]|\]|\[|\/|\\\|\"|\|/",$xss)){
            return 3;
        }
        return 1;
    }
}