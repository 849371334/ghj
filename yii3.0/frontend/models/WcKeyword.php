<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_keyword".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $num
 * @property string $key_name
 */
class WcKeyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'num'], 'integer'],
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
            'num' => 'Num',
            'key_name' => 'Key Name',
        ];
    }

    /**
     * @param $id
     * @param $where
     * @return array|\yii\db\ActiveRecord[]
     */
    public function search($id, $where)
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
