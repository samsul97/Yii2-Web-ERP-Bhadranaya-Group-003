<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TbEmpCariers;

/**
 * TbEmpCariersSearch represents the model behind the search form of `frontend\models\TbEmpCariers`.
 */
class TbEmpCariersSearch extends TbEmpCariers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_education', 'id_major', 'college', 'id_reference'], 'integer'],
            [['name', 'address', 'email', 'telp', 'ipk', 'apprenticeship', 'url', 'yof', 'yoo', 'cv', 'transcripts', 'status', 'created_at', 'timestamp'], 'safe'],
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
        $query = TbEmpCariers::find();

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
            'id_education' => $this->id_education,
            'id_major' => $this->id_major,
            'college' => $this->college,
            'apprenticeship' => $this->apprenticeship,
            'id_reference' => $this->id_reference,
            'yof' => $this->yof,
            'yoo' => $this->yoo,
            'created_at' => $this->created_at,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'ipk', $this->ipk])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'cv', $this->cv])
            ->andFilterWhere(['like', 'transcripts', $this->transcripts])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
