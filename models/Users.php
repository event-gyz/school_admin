<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $uid
 * @property string $id
 * @property string $last_name
 * @property string $first_name
 * @property string $nick_name
 * @property integer $gender
 * @property string $birth_day
 * @property string $image_url
 * @property integer $supervisor_uid
 * @property string $type_0
 * @property string $type_1
 * @property string $type_2
 * @property string $type_3
 * @property string $type_4
 * @property string $type_5
 * @property string $weight_index
 * @property string $height_index
 * @property integer $buds_index
 * @property integer $agency_id
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_name', 'first_name', 'gender', 'birth_day', 'image_url', 'supervisor_uid', 'buds_index'], 'required'],
            [['gender', 'supervisor_uid', 'buds_index'], 'integer'],
            [['birth_day'], 'safe'],
            [['id', 'last_name', 'first_name', 'nick_name'], 'string', 'max' => 50],
            [['image_url'], 'string', 'max' => 255],
            [['type_0', 'type_1', 'type_2', 'type_3', 'type_4', 'type_5', 'weight_index', 'height_index'], 'string', 'max' => 5],
            [['nick_name', 'supervisor_uid'], 'unique', 'targetAttribute' => ['nick_name', 'supervisor_uid'], 'message' => 'The combination of 昵称 and Supervisor Uid has already been taken.'],
        ];
    }

    public function getMember(){
        return $this->hasOne(Member::className(),['uid'=>'supervisor_uid']);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'id' => 'ID',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'nick_name' => '昵称',
            'gender' => '0 男 1女',
            'birth_day' => 'Birth Day',
            'image_url' => 'Image Url',
            'supervisor_uid' => 'Supervisor Uid',
            'type_0' => '语言',
            'type_1' => '社交',
            'type_2' => '粗大动作',
            'type_3' => '细微动作',
            'type_4' => '认知',
            'type_5' => '自我帮助',
            'weight_index' => '体重指数 大于100偏高 小于100偏低',
            'height_index' => '身高指数 大于100偏高 小于100偏低',
            'buds_index' => '牙齿指数 9偏早 10正常 11偏晚',
        ];
    }
}
