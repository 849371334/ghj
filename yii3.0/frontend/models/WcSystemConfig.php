<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_system_config".
 *
 * @property string $id
 * @property integer $acct_id
 * @property string $key
 * @property string $data
 * @property integer $is_record
 * @property integer $rec_time
 */
class WcSystemConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_system_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acct_id'], 'required'],
            [['acct_id', 'is_record', 'rec_time'], 'integer'],
            [['data'], 'string'],
            [['key'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acct_id' => 'Acct ID',
            'key' => 'Key',
            'data' => 'Data',
            'is_record' => 'Is Record',
            'rec_time' => 'Rec Time',
        ];
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function search($id)
    {
        return $this->find()->select('is_record, rec_time')->where("acct_id = '$id'")->asArray()->one();
    }

    /**
     * @param $id
     * @param $data
     * @return int
     */
    public function up($id, $data)
    {
        return $this->updateAll($data, ['acct_id'=>$id]);
    }
}
