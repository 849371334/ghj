<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_user_media}}".
 *
 * @property string $id
 * @property integer $media_id
 * @property integer $wechat_id
 * @property integer $add_time
 * @property integer $edit_time
 * @property string $keyword
 * @property string $author
 * @property string $is_material
 * @property string $media_url
 */
class WcMedid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_user_media}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_id', 'wechat_id', 'is_material'], 'required'],
            [['media_id', 'wechat_id', 'add_time', 'edit_time'], 'integer'],
            [['keyword', 'author'], 'string', 'max' => 10],
            [['is_material'], 'string', 'max' => 20],
            [['media_url'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'media_id' => 'Media ID',
            'wechat_id' => 'Wechat ID',
            'add_time' => 'Add Time',
            'edit_time' => 'Edit Time',
            'keyword' => 'Keyword',
            'author' => 'Author',
            'is_material' => 'Is Material',
            'media_url' => 'Media Url',
        ];
    }

    //添加 数据
    public function add($a)
    {
        $this->setAttributes($a);
        return $this->insert();
    }

    //查询一条数据
    public  function findId($id,$type)
    {
        return $this->find()->where(['wechat_id'=>$id],['keyword' => $type])->asArray()->one();
    }
}
