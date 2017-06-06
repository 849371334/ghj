<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property string $account
 * @property string $name
 * @property string $encodingaeskey
 * @property string $origina
 * @property string $appid
 * @property string $appsecret
 * @property string $config_token
 * @property string $desc
 * @property string $reply
 * @property string $head_url
 */
class Account extends \yii\db\ActiveRecord
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
            [['account'], 'string', 'max' => 30],
            [['name', 'config_token'], 'string', 'max' => 10],
            [['encodingaeskey'], 'string', 'max' => 43],
            [['origina', 'appid'], 'string', 'max' => 20],
            [['appsecret'], 'string', 'max' => 32],
            [['desc', 'reply', 'head_url', 'qcode'], 'string', 'max' => 50],
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
            'account' => 'Account',
            'name' => 'Name',
            'encodingaeskey' => 'Encodingaeskey',
            'origina' => 'Origina',
            'appid' => 'Appid',
            'appsecret' => 'Appsecret',
            'config_token' => 'Config Token',
            'desc' => 'Desc',
            'reply' => 'Reply',
            'head_url' => 'Head Url',
            'qcode' => 'Qcode',
        ];
    }

    /*
     * @添加一条数据
     * */
    public  function  addOne($data)
    {
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }

    /*
    * @获取一条数据
    * */
    public  function  getOne($id,$uid)
    {
        return $this->find()->where(['id'=>$id])->andWhere(['user_id'=>$uid])->asArray()->one();
    }

     /*
     * 搜索一条数据
     * */
     public  function  Search($data,$id)
     {
         return Account::find()->where(['name'=>$data])->andWhere(['user_id'=>$id])->asArray()->one();
     }

     /*
      * 获取所有的数据
      * */
     public  function  getAll($id)
     {
         return $this->find()->where(['user_id'=>$id])->asArray()->all();
     }

     /*
      * 删除一条数据
      * */
     public  function  deleteOne($id)
     {
         return $this->deleteAll(['id'=>$id]);
     }

     /*条件搜索字段出现次数*/
     public  function  getCount($id)
     {
         return Account::find()->where(['user_id'=>$id])->count();
     }

    /**
     * @param $uid
     * @param $aid
     * @return array|null|\yii\db\ActiveRecord
     * @author：zyj
     */
    public function account($uid,$aid)
    {
        return Account::find()->where("user_id = :uid",['uid'=>$uid])->andWhere("id = :aid",['aid'=>$aid])->asArray()->one();
    }

    /**
     * @param $data
     * @return int
     * @author：zyj
     */
    public function change($data)
    {
        return $this->updateAll($data,['id'=>$data['id']]);
    }



}
