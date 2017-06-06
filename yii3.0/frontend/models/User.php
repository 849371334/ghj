<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $time
 * @property integer $password
 * @property integer $status
 * @property string $username
 * @property string $ip_address
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'time', 'password', 'status'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['ip_address'], 'string', 'max' => 15],
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
            'time' => 'Time',
            'password' => 'Password',
            'status' => 'Status',
            'username' => 'Username',
            'ip_address' => 'Ip Address',
        ];
    }
}
