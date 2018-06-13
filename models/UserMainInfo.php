<?php

namespace app\models;

use Yii;
use app\core\HActiveRecord;

/**
 * This is the model class for table "user_main_info".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $true_name
 * @property string $email
 * @property integer $email_validate
 * @property string $mobile_phone
 * @property integer $mobile_phone_validate
 * @property integer $pwd_import
 * @property integer $source
 * @property integer $cdgn_uid
 * @property integer $mice_uid
 * @property integer $service_uid
 * @property string $unionid
 * @property string $openid
 * @property string $openid_eventown2013
 * @property integer $create_time
 * @property string $update_time
 * @property integer $status
 */
class UserMainInfo extends HActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_main_info';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_user_center');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_validate', 'mobile_phone_validate', 'pwd_import', 'source', 'cdgn_uid', 'mice_uid', 'service_uid', 'create_time', 'status'], 'integer'],
            [['update_time'], 'safe'],
            [['username', 'mobile_phone', 'unionid', 'openid', 'openid_eventown2013'], 'string', 'max' => 50],
            [['password', 'email'], 'string', 'max' => 100],
            [['true_name'], 'string', 'max' => 20],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'true_name' => Yii::t('app', 'True Name'),
            'email' => Yii::t('app', 'Email'),
            'email_validate' => Yii::t('app', 'Email Validate'),
            'mobile_phone' => Yii::t('app', 'Mobile Phone'),
            'mobile_phone_validate' => Yii::t('app', 'Mobile Phone Validate'),
            'pwd_import' => Yii::t('app', 'Pwd Import'),
            'source' => Yii::t('app', 'Source'),
            'cdgn_uid' => Yii::t('app', 'Cdgn Uid'),
            'mice_uid' => Yii::t('app', 'Mice Uid'),
            'service_uid' => Yii::t('app', 'Service Uid'),
            'unionid' => Yii::t('app', 'Unionid'),
            'openid' => Yii::t('app', 'Openid'),
            'openid_eventown2013' => Yii::t('app', 'Openid Eventown2013'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getEvenWorkerInfo($uid) {
        try{
            $client = HActiveRecord::getRpcClient('Rpc_service','eventUserRpc');
            return $result = $client->get_user_info_by_id($uid);
        }catch ( Exception $e ){
            return array( 'status'=>-99,'msg'=>$e->getErrors(),'data'=>'' );
        }

    }
    
    
    public static function getUserInfoByIds( $ids=[] ){
        $user = self::find()->where(['id'=>  array_filter($ids)])->asArray()->all();
        $userData = [];
        foreach ($user as $value){
            $key = $value['id'];
            $userData[$key] = $value;
        }
        return $userData;
    }

    /**
     * 获取用户信息
     *
     * @param $userId
     */
    public static function getUser($userId)
    {
        return self::findOne(['id' => $userId])->toArray();
    }

    public function updateUser($data,$where){
        $res = UserMainInfo::updateAll( $data,$where);
        //$sql = "select * from %s where `username`= '%s'";
//        $res = self::getDb()->createCommand($sql)->execute();
        return $res;
    }
}
