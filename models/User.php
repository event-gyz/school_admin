<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $uid;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $phone;
    public $email;
    public $city;
    public $img;
    public $type;
    public $area;
    public $type_of_cooperation;
    public $create_time;
    public $status;
    public $authKey;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = Admin::find()->where(['uid' => $id])->asArray()->one();

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
        $user = Admin::find()->where(['username' => $username])->orWhere(['phone' => $username])->asArray()->one();
        if ($user) {

            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->uid;
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

