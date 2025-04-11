<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbAssetsRepair;

/**
 * TbAssetsRepairSearch represents the model behind the search form of `backend\models\TbAssetsRepair`.
 */
class TbAssetsRepairSearch extends TbAssetsRepair
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tb_assets', 'id_user', 'qty_repair'], 'integer'],
            [['condition_issue', 'status', 'dor', 'timestamp'], 'safe'],
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
        $query = TbAssetsRepair::find();

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
            'id_tb_assets' => $this->id_tb_assets,
            'id_user' => $this->id_user,
            'dor' => $this->dor,
            'qty_repair' => $this->qty_repair,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
        ->andFilterWhere(['like', 'condition_issue', $this->condition_issue]);

        return $dataProvider;
    }
}
