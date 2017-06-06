<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vip_user".
 *
 * @property integer $vip_id
 * @property integer $vip_points
 * @property string $vip_tel
 * @property string $vip_name
 * @property string $vip_email
 * @property string $vip_group
 * @property string $vip_pwd
 * @property string $vip_balance
 */
class VipUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vip_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_points', 'vip_pwd'], 'integer'],
            [['vip_balance'], 'number'],
            [['vip_tel'], 'string', 'max' => 11],
            [['vip_name'], 'string', 'max' => 5],
            [['vip_email'], 'string', 'max' => 30],
            [['vip_group'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vip_id' => 'Vip ID',
            'vip_points' => 'Vip Points',
            'vip_tel' => 'Vip Tel',
            'vip_name' => 'Vip Name',
            'vip_email' => 'Vip Email',
            'vip_group' => 'Vip Group',
            'vip_pwd' => 'Vip Pwd',
            'vip_balance' => 'Vip Balance',
        ];
    }
    
    /**
     * @param $vip_data
     * @return bool
     * 会员添加方法
     */
    public function vip_add($vip_data)
    {
        $this->setAttributes($vip_data);
         return $this ->insert();
    }
}
