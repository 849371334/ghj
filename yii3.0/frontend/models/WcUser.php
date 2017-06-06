<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%wc_user}}".
 *
 * @property string $id
 * @property integer $group_id
 * @property integer $node_time_start
 * @property integer $node_time_end
 * @property integer $end_time
 * @property integer $time
 * @property integer $status
 * @property string $password
 * @property string $digit
 * @property string $username
 * @property string $mobile
 * @property string $ip_address
 * @property string $end_ip
 * @property string $email
 */
class WcUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wc_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'end_time', 'time', 'status', 'password'], 'integer'],
            [['digit'], 'required'],
            [['digit'], 'string', 'max' => 5],
            [['username'], 'string', 'max' => 6],
            [['mobile'], 'string', 'max' => 11],
            [['ip_address', 'end_ip'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 30],
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
            'end_time' => 'End Time',
            'time' => 'Time',
            'status' => 'Status',
            'password' => 'Password',
            'digit' => 'Digit',
            'username' => 'Username',
            'mobile' => 'Mobile',
            'ip_address' => 'Ip Address',
            'end_ip' => 'End Ip',
            'email' => 'Email',
        ];
    }


    /**
     * @param $where
     * @param $user
     * @param $pwd
     * @return array|null|\yii\db\ActiveRecord
     */
    public function login($where, $user, $pwd)
    {
        return $this->find()->where(" $where = :user",[':user'=>$user])->andWhere("password = :pwd",[':pwd'=>$pwd])->asArray()->one();
    }

    /**
     * @param $data
     * @param $id
     * @return int
     */
    public function loginDO($data, $id)
    {
        return $this->updateAll($data,['id'=> $id]);
    }

    /**
     * @ get array
     */
    public function getAll()
    {
        return WcUser::find()->asArray()->all();
    }

    /**
     * @ get array
     */
    public function getOne($id)
    {
        return $this->find()->where(['id'=>$id])->asArray()->one();
    }

    /**
     * @param $arr
     * @return mixed
     * 控制器传输过来的数组 $arr进行数据入库
     */
    public  function  regist_add($arr)
    {
        $sql="insert  into wc_user (`username`,`password`,`mobile`,`email`,`time`') VALUES ('$arr[username]','$arr[password]','$arr[mobile]','$arr[email]','$arr[time]'')";
        return $this->db->createCommand($sql)->query();

    }
    /**
     * @param $arr
     * @return array|null|\yii\db\ActiveRecord
     * 根据看控制器传过来的数据 取出里面的手机号作为条件进行查询
     */
    public function regist_select($arr)
    {
        return $this->find()->where(['username'=>$arr['username']])->asArray()->one();
    }

    /**
     * @param $post
     * @param $encrypt_password $username
     * @return array|null|\yii\db\ActiveRecord
     * 查询数据进行匹配验证
     */
    public function login_sel($username)
    {
        return $this->find()->where(['username'=>$username])->asArray()->one();
    }




}