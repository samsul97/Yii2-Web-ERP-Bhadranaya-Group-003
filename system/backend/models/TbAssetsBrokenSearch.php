<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbAssetsBroken;

/**
 * TbAssetsBrokenSearch represents the model behind the search form of `backend\models\TbAssetsBroken`.
 */
class TbAssetsBrokenSearch extends TbAssetsBroken
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tb_assets', 'qty_broken', 'id_user'], 'integer'],
            [['is_condition', 'condition_issue', 'dob', 'status', 'timestamp'], 'safe'],
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
        $query = TbAssetsBroken::find();

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
            'id_tb_assets' => $this->id,
            'id_user' => $this->id_user,
            'dob' => $this->dob,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'is_condition', $this->is_condition])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'qty_broken', $this->qty_broken])
            ->andFilterWhere(['like', 'condition_issue', $this->condition_issue]);
        return $dataProvider;
    }
}
