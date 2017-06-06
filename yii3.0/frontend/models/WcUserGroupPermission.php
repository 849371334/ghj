<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_user_group_permission}}".
 *
 * @property string $id
 * @property string $pid
 * @property string $gid
 */
class WcUserGroupPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_user_group_permission}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'gid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'gid' => 'Gid',
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

    /**
     * @inheritdoc  批量添加
     * @params   $add  array 添加数据
     */
    public function add_all($add)
    {
        $connection = \Yii::$app->db;
        //数据批量入库
        $connection->createCommand()->batchInsert(
            'wc_user_group_permission',//表名
            ['pid','gid'],//字段
            $add
        )->execute();
    }

    /**
     * @inheritdoc  获取用户组权限
     * @params   $find  array 查询数据
     */
    public function getAll($id)
    {
        return $this->find()->where(['gid'=>$id])->asArray()->all();

    }

    /**
     * @inheritdoc  删除用户组权限
     * @params    delete
     */
    public function del1($id)
    {
        return $this->deleteAll(['gid'=>$id]);
    }
}
