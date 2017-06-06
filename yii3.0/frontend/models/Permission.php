<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_user_permission}}".
 *
 * @property string $id
 * @property string $action
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_user_permission}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
        ];
    }

    /**
     * @ add data
     */
    public function add_name($data)
    {
        $this->setAttributes($data);
        return $this->insert();
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

    /**
     * @inheritdoc  获取用户组权限
     * @params   $add  array 查询数据
     */
    public function getNode($id)
    {
        return $this->find()->where(['id'=>$id])->asArray()->all();

    }

    //查找用户拥有的方法
    public  function getNodes($id)
    {
        return $this->find()->where(['in','id',$id])->asArray()->all();
    }


}
