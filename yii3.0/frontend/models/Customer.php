<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_customer}}".
 *
 * @property integer $id
 * @property integer $wechat_id
 * @property integer $kf_id
 * @property integer $accepted_case
 * @property integer $status
 * @property string $kf_nick
 * @property string $kf_account
 * @property string $kf_headimgurl
 * @property string $kf_wx
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id', 'kf_id'], 'required'],
            [['wechat_id', 'kf_id', 'accepted_case', 'status'], 'integer'],
            [['kf_nick'], 'string', 'max' => 10],
            [['kf_account'], 'string', 'max' => 30],
            [['kf_headimgurl', 'kf_wx'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wechat_id' => 'Wechat ID',
            'kf_id' => 'Kf ID',
            'accepted_case' => 'Accepted Case',
            'status' => 'Status',
            'kf_nick' => 'Kf Nick',
            'kf_account' => 'Kf Account',
            'kf_headimgurl' => 'Kf Headimgurl',
            'kf_wx' => 'Kf Wx',
        ];
    }

    /**
    author : yuminglei 
    email  : yuminglei12@cn331.com
    datetime : 5-16 10:18
    function : check datas in the table wc_customer of database which kf_account includes 'keywords'
    */

    public function find_customer($keyword){
        return $this->find()->where("'kf_account' like '%$keyword%' ")->asArray()->all();
    }
}
