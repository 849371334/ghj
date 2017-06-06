<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_account".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property string $encodingaeskey
 * @property string $appsecret
 * @property string $config_token
 * @property string $account
 * @property string $name
 * @property string $origina
 * @property string $appid
 * @property string $head_url
 * @property string $desc
 * @property string $reply
 */
class WcAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type'], 'integer'],
            [['encodingaeskey'], 'string', 'max' => 43],
            [['appsecret'], 'string', 'max' => 32],
            [['config_token', 'name'], 'string', 'max' => 10],
            [['account', 'head_url'], 'string', 'max' => 30],
            [['origina', 'appid'], 'string', 'max' => 20],
            [['desc', 'reply'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'encodingaeskey' => 'Encodingaeskey',
            'appsecret' => 'Appsecret',
            'config_token' => 'Config Token',
            'account' => 'Account',
            'name' => 'Name',
            'origina' => 'Origina',
            'appid' => 'Appid',
            'head_url' => 'Head Url',
            'desc' => 'Desc',
            'reply' => 'Reply',
        ];
    }
}
