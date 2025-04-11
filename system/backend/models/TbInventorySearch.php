<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbInventory;

/**
 * TbInventorySearch represents the model behind the search form of `backend\models\TbInventory`.
 */
class TbInventorySearch extends TbInventory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'id_in_parent', 'id_in_type', 'id_in_unit'], 'integer'],
            [['sku', 'desc', 'code_satuan', 'code_in', 'code_out', 'code_log', 'code_waste'], 'safe'],
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
        $query = TbInventory::find();

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
            'id_in_parent' => $this->id_in_parent,
            'id_in_type' => $this->id_in_type,
            'id_in_unit' => $this->id_in_unit,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'code_satuan', $this->code_satuan])
            ->andFilterWhere(['like', 'code_in', $this->code_in])
            ->andFilterWhere(['like', 'code_out', $this->code_out])
            ->andFilterWhere(['like', 'code_log', $this->code_log])
            ->andFilterWhere(['like', 'code_waste', $this->code_waste]);

        return $dataProvider;
    }
}
