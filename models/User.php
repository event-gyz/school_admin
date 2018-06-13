<?php

namespace app\models;
use app\models\Company;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $user_id;
    public $real_name;
    public $email;
    public $mobile_num;
    public $create_time;
    public $status;
    public $job_num;
    public $company_id;
    public $role;
    public $en_name;
    public $department;
    public $job_phone;
    public $password;
    public $authKey;
    public $accessToken;
    public $dept_id;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = Users::find()->where(['user_id' => $id])->asArray()->one();

        if ($user) {
            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = Users::find()->where(['email' => $username])->orWhere(['mobile_num' => $username])->asArray()->one();

        if ($user) {
            $model = new Company();
            $company = $model->getCompanyById($user['company_id'])->attributes;

            \Yii::$app->session['company'] = $company;

            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }
}

