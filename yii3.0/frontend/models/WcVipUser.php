<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "wc_vip_user".
 *
 * @property integer $id
 * @property integer $credit1
 * @property string $mobile
 * @property string $realname
 * @property string $email
 * @property integer $groupid
 * @property string $password
 * @property string $credit2
 * @property integer $vip_id
 */
class WcVipUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wc_vip_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credit1', 'groupid', 'password', 'vip_id'], 'integer'],
            [['credit2'], 'number'],
            [['mobile'], 'string', 'max' => 11],
            [['realname'], 'string', 'max' => 5],
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
            'credit1' => 'Credit1',
            'mobile' => 'Mobile',
            'realname' => 'Realname',
            'email' => 'Email',
            'groupid' => 'Groupid',
            'password' => 'Password',
            'credit2' => 'Credit2',
            'vip_id' => 'Vip ID',
        ];
    }

    /**
     * 查询所有会员组所属会员
     * @return array|\yii\db\ActiveRecord[]
     * @auther zyj
     */
    public function vip_user_sel($id)
    {
        return $this->find()->where("vip_id = :id",['id'=>$id])->asArray()->all();
    }

    /**
     * 查询所有会员组所属会员
     * @return array|\yii\db\ActiveRecord[]
     * @auther zyj
     */
    public function vip_user_sels($id,$w_time,$groupid,$w_user,$user)
    {
        if ($w_user == ''){
            $w_user = '1';
            $user = '1';
        }
        if ($groupid == ''){
            $group = '1';
            $groupid = '1';
        } else {
            $group = 'groupid';
        }
        return $this->find()->where("vip_id = :id",['id'=>$id])->andWhere($w_time)->andWhere("$group = :groupid",['groupid'=>$groupid])->andWhere("$w_user = :user",['user'=>$user])->asArray()->all();
    }

    /**
     * 添加新会员
     * @param $data
     * @return bool
     * @author zyj
     */
    public function add($data)
    {
        $this->setAttributes($data);//载入数据
        return $this->insert();//返回结果
    }

    /**
     * @param $user
     * @param $key
     * @param $min
     * @param $max
     * @return array|\yii\db\ActiveRecord[]
     */
    public function points($user,$key,$min,$max)
    {
        if($key == ''){
            $w_user = '1=1';
        } else {
            $w_user = "$user like '%$key%'";
        }
        return $this->find()->where($w_user)->andWhere("credit1 BETWEEN :min AND :max",['min'=>$min,'max'=>$max])->asArray()->all();
    }

    /**
     * 修改
     * @param $id
     * @param $data
     * @return int
     */
    public function change($id,$data)
    {
        return $this->updateAll($data,['id'=>$id]);
    }

    /**
     * @param $id
     * @param $hid
     * @return array|\yii\db\ActiveRecord[]
     */
    public function sel($id,$hid)
    {
        return $this->find()->where("vip_id = :id AND id = :hid",['id'=>$id,'hid'=>$hid])->asArray()->one();
    }

    public function del_s($u)
    {
        return $this->deleteAll(['id' => $u ]);
    }
}
