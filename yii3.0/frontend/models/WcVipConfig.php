<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_vip_config".
 *
 * @property integer $id
 * @property string $uid
 * @property string $field
 * @property string $title
 * @property integer $is_enable
 * @property integer $sort
 */
class WcVipConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_vip_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_enable', 'sort'], 'integer'],
            [['uid', 'field', 'title'], 'string', 'max' => 20],
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
            'field' => 'Field',
            'title' => 'Title',
            'is_enable' => 'Is Enable',
            'sort' => 'Sort',
        ];
    }

    /**
     * 配置查询
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function status($id)
    {
        return $this->find()->where("uid = :id",['id'=>$id])->asArray()->all();
    }

    public function config($id)
    {
        return $this->find()->where("uid = :id AND is_enable = 1",['id'=>$id])->asArray()->all();
    }

    /**
     * 单项配置查询
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public function sel($id)
    {
        return $this->find()->where("id = :id",['id'=>$id])->asArray()->one();
    }

    /**
     * 删除
     * @param $id
     * @return int
     */
    public function del($id)
    {
        return $this->deleteAll(['id'=>$id]);
    }

    /**
     * 字段编辑
     * @param $data
     * @return int
     */
    public function change($data)
    {
        return $this->updateAll($data,['id'=>$data['id']]);
    }

    public function add($data){
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }
}
