<?php

namespace backend\modules\tag\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\tag\models\Tag;

/**
 * TagSearch represents the model behind the search form about `backend\modules\tag\models\Tag`.
 */
class TagSearch extends Tag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['title', 'created_at', 'updated_at'], 'safe'],
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
        $query = Tag::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        if ( ! is_null($this->created_at) && strpos($this->created_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->created_at);
            $query->andFilterWhere(['between', 'created_at', strtotime($start_date), strtotime($end_date.' 23:59:59')]);
        }

        if ( ! is_null($this->updated_at) && strpos($this->updated_at, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->updated_at);
            $query->andFilterWhere(['between', 'updated_at', strtotime($start_date), strtotime($end_date.' 23:59:59')]);
        }

        return $dataProvider;
    }
}
