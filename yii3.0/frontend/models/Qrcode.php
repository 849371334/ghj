<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_qrcode}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $scene_id
 * @property integer $end_time
 * @property integer $add_time
 * @property integer $scan_num
 * @property integer $wechat_id
 * @property integer $type
 * @property integer $status
 * @property integer $sort
 * @property string $key_name
 * @property string $scene_name
 * @property string $qrcode_url
 * @property string $ticket
 */
class Qrcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_qrcode}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'scene_id', 'end_time', 'add_time', 'scan_num', 'wechat_id', 'type', 'status', 'sort'], 'integer'],
            [['key_name', 'scene_name'], 'string', 'max' => 30],
            [['qrcode_url'], 'string', 'max' => 60],
            [['ticket'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'scene_id' => 'Scene ID',
            'end_time' => 'End Time',
            'add_time' => 'Add Time',
            'scan_num' => 'Scan Num',
            'wechat_id' => 'Wechat ID',
            'type' => 'Type',
            'status' => 'Status',
            'sort' => 'Sort',
            'key_name' => 'Key Name',
            'scene_name' => 'Scene Name',
            'qrcode_url' => 'Qrcode Url',
            'ticket' => 'Ticket',
        ];
    }
    //insert data into the table qrcode
    public function insertdata($data){
        return Yii::$app ->db ->createCommand()->insert("wc_qrcode",$data)->execute();
    }
    //select * from table where keyword=$keyword;
    public function finddata($data){
        return $this->find()->where(['scene_name'=>$data])->asarray()->all();
    }
    //find useless codes and delete them
    public function findids($user_id,$now){
        return $this -> find()-> where(['user_id' => $user_id]) -> andwhere(['<=', 'end_time', $now]) -> asarray() -> all();
    }
    //delete codes 
    public function delcodes($ids){
        return $this -> deleteAll("id in $ids");
    }
}
