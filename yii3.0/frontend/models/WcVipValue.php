<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_vip_value".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $hid
 * @property integer $cid
 * @property string $word
 */
class WcVipValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_vip_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'hid', 'cid'], 'integer'],
            [['word'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'hid' => 'Hid',
            'cid' => 'Cid',
            'word' => 'Word',
        ];
    }

    /**
     * @param $uid
     * @param $hid
     * @return array|\yii\db\ActiveRecord[]
     */
    public function value($uid,$hid)
    {
        return $this->find()->where("uid = :uid AND hid = :hid",['uid'=>$uid,'hid'=>$hid])->asArray()->all();
    }

    public function change($id,$data)
    {
        return $this->updateAll($data,['id'=>$id]);
    }

    public function add($data)
    {
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }
}
