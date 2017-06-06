<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_media}}".
 *
 * @property string $id
 * @property integer $sort
 * @property integer $size
 * @property integer $is_show
 * @property integer $type
 * @property string $title
 * @property string $file_name
 * @property string $digest
 * @property string $link
 * @property string $file
 * @property string $name
 * @property string $content
 */
class WcMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_media}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort'], 'required'],
            [['sort', 'size', 'is_show', 'type'], 'integer'],
            [['title'], 'string', 'max' => 20],
            [[ 'digest', 'link', 'file', 'name'], 'string', 'max' => 50],
            [['file_name'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 180],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sort' => 'Sort',
            'size' => 'Size',
            'is_show' => 'Is Show',
            'type' => 'Type',
            'title' => 'Title',
            'file_name' => 'File Name',
            'digest' => 'Digest',
            'link' => 'Link',
            'file' => 'File',
            'name' => 'Name',
            'content' => 'Content',
        ];
    }

    //添加数据
    public function add($data)
    {
        $this->setAttributes($data);
        return $this->insert();
    }

    //查询数据
    public  function  selectId($id)
    {
        return $this->find()->where(['id'=>$id])->asArray()->one();
    }

}
