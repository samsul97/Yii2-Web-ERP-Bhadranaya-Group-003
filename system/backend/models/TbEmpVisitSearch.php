<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbEmpVisit;

/**
 * TbEmpVisitSearch represents the model behind the search form of `backend\models\TbEmpVisit`.
 */
class TbEmpVisitSearch extends TbEmpVisit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_tkp'], 'integer'],
            [['necessity', 'vehicle', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TbEmpVisit::find();

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
            'id_user' => $this->id_user,
            'id_tkp' => $this->id_tkp,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'necessity', $this->necessity])
            ->andFilterWhere(['like', 'vehicle', $this->vehicle]);

        return $dataProvider;
    }
}
