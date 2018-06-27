<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $uid
 * @property string $id
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $nickname
 * @property string $cellphone
 * @property string $email
 * @property string $wx_openid
 * @property string $city
 * @property string $address
 * @property integer $credit
 * @property string $image_url
 * @property string $father_image
 * @property string $mother_image
 * @property integer $epaper
 * @property integer $show_id
 * @property string $membership
 * @property integer $share_time
 * @property string $create_time
 * @property integer $agency_id
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credit', 'epaper', 'show_id', 'share_time', 'agency_id'], 'integer'],
            [['create_time'], 'safe'],
            [['id'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 128],
            [['first_name', 'last_name', 'cellphone'], 'string', 'max' => 20],
            [['nickname', 'wx_openid', 'city', 'address', 'image_url', 'father_image', 'mother_image', 'membership'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
        ];
    }

    public function getUser(){
        return $this->hasOne(Users::className(),['supervisor_uid'=>'uid']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'id' => '邮箱',
            'password' => '密码',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'nickname' => '昵称',
            'cellphone' => '手机号',
            'email' => '邮箱',
            'wx_openid' => '微信用户openid',
            'city' => '城市',
            'address' => '家庭地址',
            'credit' => 'Credit',
            'image_url' => '头像',
            'father_image' => '爸爸头像',
            'mother_image' => '妈妈头像',
            'epaper' => 'Epaper',
            'show_id' => 'Show ID',
            'membership' => '会员有效期',
            'share_time' => '推广次数',
            'create_time' => '新增时间',
            'agency_id' => '代理商ID。   0:无代理商 ',
        ];
    }
}
