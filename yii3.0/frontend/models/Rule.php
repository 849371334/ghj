<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_user_group_rule}}".
 *
 * @property string $id
 * @property string $uid
 * @property string $gid
 */
class Rule extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_user_group_rule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'gid'], 'integer'],
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
            'gid' => 'Gid',
        ];
    }

    /**
     * @ add data
     */
    public function add2($id)
    {
        $data = array('id'=>'','uid'=>$id,'gid'=>0);
        $this->setAttributes($data);
        return $this->insert();
    }

    /**
     * @ add data
     */
    public function add_name($data)
    {
        $this->setAttributes($data);
        return $this->insert();
    }

    /**
     * @ get array
     */
    public function getAll()
    {
        return Rule::find()->asArray()->all();
    }

    /*
   * delete one id
   */
    public function del1($id)
    {
        return $this->deleteAll(['uid'=>$id]);
    }

    /**
     * int =>array
     * @ get array
     */
    public function getOne($id)
    {
        return $this->find()->where(['uid'=>$id])->asArray()->one();
    }
}
