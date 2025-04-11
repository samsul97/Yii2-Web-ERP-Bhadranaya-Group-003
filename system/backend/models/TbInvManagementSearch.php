<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbInvManagement;

/**
 * TbInvManagementSearch represents the model behind the search form of `backend\models\TbInvManagement`.
 */
class TbInvManagementSearch extends TbInvManagement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'in_arrival', 'in_selling', 'out_sales', 'out_non_sales', 'waste', 'spoiled', 'id_inventory', 'id_user', 'id_in_type', 'last_stock'], 'integer'],
            [['remarks', 'timestamp', 'updated_at'], 'safe'],
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
        $query = TbInvManagement::find();

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
            'id_inventory' => $this->id_inventory,
            'id_in_type' => $this->id_in_type,
            'id_user' => $this->id_user,
            'in_arrival' => $this->in_arrival,
            'in_selling' => $this->in_selling,
            'out_sales' => $this->out_sales,
            'out_non_sales' => $this->out_non_sales,
            'waste' => $this->waste,
            'spoiled' => $this->spoiled,
            'last_stock' => $this->last_stock,
            'updated_at' => $this->updated_at,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
