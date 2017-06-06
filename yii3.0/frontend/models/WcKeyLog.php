<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_key_log".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $key_id
 * @property integer $num
 * @property integer $time
 * @property string $key_name
 */
class WcKeyLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_key_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'key_id'], 'required'],
            [['user_id', 'key_id', 'num', 'time'], 'integer'],
            [['key_name'], 'string', 'max' => 30],
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
            'key_id' => 'Key ID',
            'num' => 'Num',
            'time' => 'Time',
            'key_name' => 'Key Name',
        ];
    }

    /**
     * @param $id
     * @param $where
     * @return array|\yii\db\ActiveRecord[]
     */
    public function sear($id,$where)
    {
        return $this->find()->where("user_id = '$id'")->andWhere($where)->asArray()->all();
    }

    /**
     * @param $id
     * @return int
     */
    public function del($id)
    {
        return $this->deleteAll(['id'=>$id]);
    }
}
