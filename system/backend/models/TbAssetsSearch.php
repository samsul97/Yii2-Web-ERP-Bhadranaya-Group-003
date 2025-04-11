<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbAssets;

/**
 * TbAssetsSearch represents the model behind the search form of `backend\models\TbAssets`.
 */
class TbAssetsSearch extends TbAssets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_tkp', 'id_in_category', 'price', 'qty', 'qty_current'], 'integer'],
            [['sku', 'name', 'brand', 'guarantee', 'completeness', 'dop', 'other_information', 'image', 'contractor', 'floor', 'power', 'timestamp'], 'safe'],
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
        $query = TbAssets::find();

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
            'id_in_category' => $this->id_in_category,
            'price' => $this->price,
            'guarantee' => $this->guarantee,
            'dop' => $this->dop,
            'qty' => $this->qty,
            'qty_current' => $this->qty_current,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'completeness', $this->completeness])
            ->andFilterWhere(['like', 'other_information', $this->other_information])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'contractor', $this->contractor])
            ->andFilterWhere(['like', 'floor', $this->floor])
            ->andFilterWhere(['like', 'power', $this->power]);

        return $dataProvider;
    }
}