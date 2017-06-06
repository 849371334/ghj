<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_account_limit}}".
 *
 * @property string $id
 * @property string $group_id
 * @property integer $account_limit
 */
class Limit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_account_limit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'account_limit'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'account_limit' => 'Account Limit',
        ];
    }

    /**
     * @ add data
     */
    public function add_limit($data)
    {
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }

    /**
     * int =>array
     * @ get array
     */
    public function getOne($id)
    {
        return $this->find()->where(['group_id'=>$id])->asArray()->one();

    }
    /**
     * @ get array
     */
    public function getAll()
    {
        return Limit::find()->asArray()->all();
    }

    /*
    * delete one id
    */
    public function del1($id)
    {
        return $this->deleteAll(['group_id'=>$id]);
    }

    /*
     * form array
     * save one id
     * return int
     */
    public function save1($data)
    {
        $result=Limit::find()->where(['group_id'=>$data['group_id']])->one();
        $result->account_limit=$data['account_limit'];
        $result->save();
    }
}
