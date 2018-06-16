<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrowLog;

/**
 * GrowLogSearch represents the model behind the search form about `app\models\GrowLog`.
 */
class GrowLogSearch extends GrowLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'user_uid', 'item_uid', 'early', 'type'], 'integer'],
            [['log_time'], 'safe'],
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
        $query = GrowLog::find();

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
            'user_uid' => $this->user_uid,
            'item_uid' => $this->item_uid,
            'log_time' => $this->log_time,
            'early' => $this->early,
            'type' => $this->type,
        ]);

        return $dataProvider;
    }
}
