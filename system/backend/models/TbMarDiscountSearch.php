<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbMarDiscount;

/**
 * TbMarDiscountSearch represents the model behind the search form of `backend\models\TbMarDiscount`.
 */
class TbMarDiscountSearch extends TbMarDiscount
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_products', 'price_discount'], 'integer'],
            [['start_date', 'end_date', 'timestamp'], 'safe'],
            [['percent'], 'number'],
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
        $query = TbMarDiscount::find();

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
            'id_products' => $this->id_products,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'percent' => $this->percent,
            'price_discount' => $this->price_discount,
            'timestamp' => $this->timestamp,
        ]);

        return $dataProvider;
    }
}
