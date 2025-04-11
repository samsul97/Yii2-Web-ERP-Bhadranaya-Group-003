<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbEmployee;

/**
 * TbEmployeeSearch represents the model behind the search form of `backend\models\TbEmployee`.
 */
class TbEmployeeSearch extends TbEmployee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tkp', 'id_company'], 'integer'],
            [['nie', 'nie_old', 'nik', 'name', 'status', 'date_join', 'date_resign', 'status_contract', 'department', 'position', 'pob', 'dob', 'gender', 'married_status', 'national', 'education', 'address', 'province', 'city', 'district', 'postcode', 'handphone', 'email', 'image'], 'safe'],
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
        $query = TbEmployee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'nie' => [
                    'asc' => ['nie' => SORT_ASC],
                    'desc' => ['nie' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
            'defaultOrder' => [
                'nie' => SORT_ASC
            ]
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
            'id_tkp' => $this->id_tkp,
            'id_company' => $this->id_company,
            'date_join' => $this->date_join,
            'date_resign' => $this->date_resign,
            'status_contract' => $this->status_contract,
            'dob' => $this->dob,
        ]);

        $query->andFilterWhere(['like', 'nie', $this->nie])
            ->andFilterWhere(['like', 'nie_old', $this->nie_old])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'pob', $this->pob])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'married_status', $this->married_status])
            ->andFilterWhere(['like', 'national', $this->national])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
