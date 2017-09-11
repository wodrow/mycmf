<?php

namespace backend\modules\log\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\log\models\Log;

/**
 * LogSearch represents the model behind the search form about `backend\modules\log\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level'], 'integer'],
            [['category', 'prefix', 'message'], 'safe'],
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
        $query = Log::find();
        $query = $query->orderBy(['id'=>SORT_DESC]);

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
            'id' => $this->id,
            'level' => $this->level,
//            'log_time' => $this->log_time,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'message', $this->message]);

        if ( ! is_null($this->log_time) && strpos($this->log_time, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->log_time);
            $query->andFilterWhere(['between', 'created_at', strtotime($start_date), strtotime($end_date.' 23:59:59')]);
        }

        return $dataProvider;
    }
}
