<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fans".
 *
 * @property integer $group_id
 * @property string $group_name
 * @property integer $group_num
 */
class WcFans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_fans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_num'], 'integer'],
            [['group_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_name' => 'Group Name',
            'group_num' => 'Group Num',
        ];
    }
    
    /**
     * @param $data
     * @return bool
     * 分组添加的方法
     */
    public function group_add($group_date)
    {
       $this->setAttributes($group_date);
       return $this->insert();
     
    }
    
    /**
     * @return array|\yii\db\ActiveRecord[]
     * 分组查询方法(全部数据)
     */
    public function group_list()
    {
        return $this->find()->all();
    }
    
    /**
     * @param $group_id
     * @return false|int
     * 分组删除方法
     */
    public function group_del($group_id)
    {
         $group_data=$this->find()->where(['group_id'=>$group_id])->one();
         return $group_arr=$group_data->delete();
    }
}
