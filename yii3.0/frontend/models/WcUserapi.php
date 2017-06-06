<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_userapi".
 *
 * @property string $id
 * @property integer $wx_id
 * @property integer $status
 * @property integer $istop
 * @property integer $priority
 * @property integer $apitype
 * @property integer $cachetime
 * @property string $reply_rule
 * @property string $keywords
 * @property string $advanced_click
 * @property string $apiurl
 * @property string $wetoken
 * @property string $default
 * @property string $apilocal
 */
class WcUserapi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_userapi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wx_id'], 'required'],
            [['wx_id', 'status', 'istop', 'priority', 'apitype', 'cachetime'], 'integer'],
            [['reply_rule', 'default'], 'string', 'max' => 15],
            [['keywords'], 'string', 'max' => 10],
            [['advanced_click', 'apiurl'], 'string', 'max' => 100],
            [['wetoken'], 'string', 'max' => 60],
            [['apilocal'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wx_id' => 'Wx ID',
            'status' => 'Status',
            'istop' => 'Istop',
            'priority' => 'Priority',
            'apitype' => 'Apitype',
            'cachetime' => 'Cachetime',
            'reply_rule' => 'Reply Rule',
            'keywords' => 'Keywords',
            'advanced_click' => 'Advanced Click',
            'apiurl' => 'Apiurl',
            'wetoken' => 'Wetoken',
            'default' => 'Default',
            'apilocal' => 'Apilocal',
        ];
    }
}
