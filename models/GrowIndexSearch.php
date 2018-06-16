<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrowIndex;

/**
 * GrowIndexSearch represents the model behind the search form about `app\models\GrowIndex`.
 */
class GrowIndexSearch extends GrowIndex
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'stid'], 'integer'],
            [['type', 'text', 'detail', 'advice', 'image_file'], 'safe'],
            [['age_min', 'age_max'], 'number'],
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
        $query = GrowIndex::find();

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
            'stid' => $this->stid,
            'age_min' => $this->age_min,
            'age_max' => $this->age_max,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'advice', $this->advice])
            ->andFilterWhere(['like', 'image_file', $this->image_file]);

        return $dataProvider;
    }
}
