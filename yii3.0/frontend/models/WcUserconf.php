<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_userconf".
 *
 * @property string $id
 * @property integer $wx_id
 * @property string $welcome
 * @property string $default
 */
class WcUserconf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_userconf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wx_id'], 'required'],
            [['wx_id'], 'integer'],
            [['welcome', 'default'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wx_id' => 'Wx ID',
            'welcome' => 'Welcome',
            'default' => 'Default',
        ];
    }

    public function add($data)
    {
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }
    public function getOne($id)
    {
        return $this->find()->where(['wx_id'=>$id])->asArray()->one();;
    }
}
