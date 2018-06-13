<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users implements \yii\web\IdentityInterface
{
    private $authKey;
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'mobile_num', 'create_time', 'status', 'company_id'], 'integer'],
            [['real_name', 'email', 'password', 'job_num'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'mobile_num' => $this->mobile_num,
            'create_time' => $this->create_time,
            'status' => $this->status,
            'company_id' => Yii::$app->user->identity->company_id,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'real_name', $this->real_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'job_num', $this->job_num]);
        return $dataProvider;
    }

    public function validatePassword($password) {
        if (empty($this->password)) {
            // 跳转到设置密码的页面
        }
        //TODO 算法验证密码是否正确
        return true;
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
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return new static(\Yii::$app->session['user_info']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return new static(\Yii::$app->session['user_info']);
    }
}
