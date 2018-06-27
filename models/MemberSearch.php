<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Member;

/**
 * MemberSearch represents the model behind the search form about `app\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['credit', 'epaper', 'show_id', 'share_time', 'agency_id'], 'integer'],
            [['id', 'password', 'first_name', 'last_name', 'nickname', 'cellphone', 'email', 'wx_openid', 'city', 'address', 'image_url', 'father_image', 'mother_image', 'membership', 'create_time'], 'safe'],
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
        $query = Member::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'uid' => $this->uid,
            'credit' => $this->credit,
            'epaper' => $this->epaper,
            'show_id' => $this->show_id,
            'share_time' => $this->share_time,
            'create_time' => $this->create_time,
            'agency_id' => $this->agency_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'cellphone', $this->cellphone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'wx_openid', $this->wx_openid])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'father_image', $this->father_image])
            ->andFilterWhere(['like', 'mother_image', $this->mother_image])
            ->andFilterWhere(['like', 'membership', $this->membership]);

        return $dataProvider;
    }
}
