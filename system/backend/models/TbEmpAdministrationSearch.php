<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbEmpAdministration;

/**
 * TbEmpAdministrationSearch represents the model behind the search form of `backend\models\TbEmpAdministration`.
 */
class TbEmpAdministrationSearch extends TbEmpAdministration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_employee', 'id_letter', 'id_user', 'no_letter'], 'integer'],
            [['no_month', 'year', 'created_at', 'timestamp'], 'safe'],
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
        $query = TbEmpAdministration::find();

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
            'id_employee' => $this->id_employee,
            'id_letter' => $this->id_letter,
            'id_user' => $this->id_user,
            'no_letter' => $this->no_letter,
            'year' => $this->year,
            'created_at' => $this->created_at,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'no_month', $this->no_month]);

        return $dataProvider;
    }
}
