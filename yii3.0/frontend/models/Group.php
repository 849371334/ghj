<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_user_group}}".
 *
 * @property string $id
 * @property string $group_name
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_user_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => 'Group Name',
        ];
    }

    /**
     * @ add data
     */
    public function add_name($data)
    {
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }

    /*
     * Gets all the information in the table
    */
    public function getAll()
    {
        return $this->find()->asArray()->all();
    }

    /*
     * delete one id
     */
    public function del1($id)
    {
        return $this->deleteAll(['id'=>$id]);
    }

    /*
     * get grouP_name
     * */
    public  function getName($id)
    {
        return $this->find()->where(['id'=>$id])->asArray()->one();
    }

}
