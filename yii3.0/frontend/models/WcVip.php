<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usergroup".
 *
 * @property string $id
 * @property string $group_name
 * @property integer $points
 */
class WcVip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_vip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credit'], 'integer'],
            [['num'], 'integer'],
            [['title'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Group Name',
            'credit' => 'Points',
            'num' => 'Num',
        ];
    }
    
    /**
     * @param $vip_group_data
     * @return bool
     * 会员组信息添加
     */
    public function vip_group_add($vip_group_data)
    {

        $this->setAttributes($vip_group_data);//载入数据
        $this->isNewRecord = true;//新插入数据
        $this->id = 0;//id为0
        return $this->save();//保存
    }

    /**
     * 查询所有会员组
     * @return array|\yii\db\ActiveRecord[]
     * @auther zyj
     */
    public function vip_group_sel($id)
    {
        return $this->find()->where("vip_id = :id",['id'=>$id])->asArray()->all();
    }

    /**
     * 修改
     * @param $data
     * @return int
     */
    public function up($data)
    {
        return $this->updateAll($data,['id'=>$data['id']]);
    }

    /**
     * 删除会员组
     * @param $id
     * @return int
     */
    public function del($id)
    {
        return $this->deleteAll(['id'=>$id]);
    }
}
