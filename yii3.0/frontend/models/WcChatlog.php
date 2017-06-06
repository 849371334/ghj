<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_chatlog".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $public_id
 * @property string $record
 * @property integer $r_time
 */
class WcChatlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_chatlog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'public_id', 'r_time'], 'integer'],
            [['record'], 'string', 'max' => 120],
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
            'public_id' => 'Public ID',
            'record' => 'Record',
            'r_time' => 'R Time',
        ];
    }

    /**
     * @param $where
     * @return array|\yii\db\ActiveRecord[]
     */
    public function search($where)
    {
        return $this->find()->where($where)->asArray()->all();
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
