<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\Query;

/**
 * This is the model class for table "b_users".
 *
 * @property integer $user_id
 * @property string $real_name
 * @property string $email
 * @property integer $mobile_num
 * @property string $password
 * @property integer $create_time
 * @property integer $status
 * @property string $job_num
 * @property integer $company_id
 */
class Users extends \yii\db\ActiveRecord
{

//    public $email;
//    public $password;

    public $secretKey;
    public $confirmPassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_users';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'real_name', 'email', ], 'required'],
            [['user_id', 'create_time', 'real_name', 'email', ], 'required','on'=>['register']],
            [['user_id', 'create_time', 'status', 'company_id'], 'integer','on'=>['default','register']],
            [['mobile_num'], 'string', 'min' => 11, 'max' => 11, 'message' => Yii::t('app', 'Invalid mobile phone number'),'on'=>['register']],
            [['email'], 'email','on'=>['default','register']],
            [['email'], 'unique', 'message' => Yii::t('app', 'Email already exists'),'on'=>['default','register']],
            [['real_name'], 'string', 'max' => 100,'on'=>['default','register']],
            [['password', 'job_num'], 'string', 'max' => 50,'on'=>['register','create','update']],
            ['password','required','on'=>['register','create']],
            ['password','string','min'=>6,'on'=>['register','create','update']],
            ['confirmPassword','required','message'=>Yii::t('app', 'Password cannot be blank'), 'on'=>['register']],
            ['mobile_num','required','message'=>Yii::t('app', 'Mobile cannot be blank'),'on'=>['register','create','update']],
            ['confirmPassword','compare','compareAttribute'=>'password','message'=>Yii::t('app', 'The password and password confirmation you entered are not the same.'),'on'=>['default','register']],
            ['secretKey','required','message'=>Yii::t('app', 'Key cannot be empty'), 'on'=>['default','register']],
            ['secretKey','isValidKey','on'=>['register']],
            ['mobile_num','checkMobileNumRepeatOne','on'=>['create']],
            ['mobile_num','checkMobileNumRepeatTwo','on'=>['update']],
        ];
    }

    public function isValidKey($attribute){
        $data = (new Query)->select('*')->from('perfessional_cd_keys')->where(['cd_key'=>$this->$attribute])
            ->createCommand(Yii::$app->db_user_center)->queryOne();
        if( false == $data || $data['status'] != 1 ){
            $this->addError($attribute, Yii::t('app', 'Invalid Key'));
        }
    }

    public function checkMobileNum(){
        if( !empty($this->mobile_num) && strlen($this->mobile_num)!= 11 ){
            $this->addError('mobile_num',Yii::t('app', 'Invalid mobile phone number'));
        }
        return true;
    }
    public function checkMobileNumRepeatOne(){
        $userInfo = Users::find()->where('mobile_num='.$this->mobile_num.' and company_id=800067')->asArray()->one();
        if( !empty($userInfo)){
            $this->addError('mobile_num',Yii::t('app', 'Mobile number already exists.'));
        }
    }
    public function checkMobileNumRepeatTwo(){
        $oldmobile_num = $this->oldAttributes['mobile_num'];
        if($oldmobile_num != $this->mobile_num){
            $userInfo = Users::find()->where('mobile_num='.$this->mobile_num)->asArray()->one();
            if( !empty($userInfo)){
                $this->addError('mobile_num',Yii::t('app', 'Mobile cannot be blank'));
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'), 'real_name' => Yii::t('app', 'Chinese Name'),
            'email' => Yii::t('app', 'Email'),
            'mobile_num' => Yii::t('app', 'Mobile'),
            'password' => Yii::t('app', 'Password'),
            'create_time' => Yii::t('app', 'Create Time'),
            'status' => Yii::t('app', 'status'),
            'job_num' => Yii::t('app', 'Employee ID'),
            'company_id' => Yii::t('app', 'Company'),
            'role' => Yii::t('app', 'Role'),
            'en_name' => Yii::t('app', 'English Name'),
            'department' => Yii::t('app', 'Department'),
            'job_phone' => Yii::t('app', 'Telephone'),
        ];
    }

    public function scenarios(){
        return [
            'register'=>['email','password','confirmPassword','secretKey'],
            'default' =>['user_id','real_name','email','mobile_num','password','create_time','status','job_num','company_id','role'],
            'create' =>['real_name','email','mobile_num','job_num','password', 'role', 'en_name', 'department', 'job_phone'],
            'update' =>['real_name','email','mobile_num','job_num','password', 'role', 'en_name', 'department', 'job_phone'],
        ];
    }

    public function register(){

        $data = [
            'create_time'=>$this->create_time,
            'update_time'=>$this->create_time,
            'secretKey'=> $this->secretKey
        ];

        $transaction = $this->db->beginTransaction();
        try{
            $this->db->createCommand()->insert('b_company',$data)->execute();
            $this->company_id = $this->db->getLastInsertID();

            $this->password = password_hash ($this->password,PASSWORD_DEFAULT);
            if( $this->save(false) ){
                $uid = $this->db->getLastInsertID();
                Yii::$app->db_user_center->createCommand()->update('perfessional_cd_keys',['status'=>2],['cd_key'=>$this->secretKey])->execute();
            }
            $transaction->commit();
            return [$this->company_id,$uid];
        }catch (Exception $e){
            $transaction->rollBack();
            return false;
        }
    }
    public function ChangeStatus($status , $id){
        $connection = $this->getDb();
        $count = $connection->createCommand()->update($this->tableName(),['status'=>$status],array('user_id'=>$id))->execute();
        if($count> 0){return true;}else{return false; }
    }




}
