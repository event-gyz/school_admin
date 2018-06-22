<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $uid
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string $img
 * @property integer $type
 * @property string $type_of_cooperation
 * @property integer $status
 * @property string $city
 * @property string $area
 * @property string $create_time
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['create_time'], 'safe'],
            [['username','type_of_cooperation','area','img'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'username' => '用户名',
            'password' => '密码',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone' => '手机号',
            'email' => '邮箱',
            'img' => '头像',
            'type' => '用户类型 1 超管 2管理员 3代理商',
            'type_of_cooperation' => '合作类型',
            'status' => '账号状态',
            'city' => '城市',
            'area'=>'区域',
            'create_time' => '添加时间',
        ];
    }
}
