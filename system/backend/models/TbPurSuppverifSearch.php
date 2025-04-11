<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbPurSuppverif;

/**
 * TbPurSuppverifSearch represents the model behind the search form of `backend\models\TbPurSuppverif`.
 */
class TbPurSuppverifSearch extends TbPurSuppverif
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tb_bf', 'id_bank'], 'integer'],
            [['type_business', 'img_nib', 'img_npwp', 'img_directur', 'name', 'residence_address', 'letter_address', 'telp', 'facsimile', 'email', 'account_number', 'swift_code', 'payment_method', 'offering_letter', 'created_at', 'no_vendor'], 'safe'],
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
        $query = TbPurSuppverif::find();

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
            'id_tb_bf' => $this->id_tb_bf,
            'id_bank' => $this->id_bank,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'type_business', $this->type_business])
            ->andFilterWhere(['like', 'img_nib', $this->img_nib])
            ->andFilterWhere(['like', 'img_npwp', $this->img_npwp])
            ->andFilterWhere(['like', 'img_directur', $this->img_directur])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'residence_address', $this->residence_address])
            ->andFilterWhere(['like', 'letter_address', $this->letter_address])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'facsimile', $this->facsimile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'swift_code', $this->swift_code])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'no_vendor', $this->no_vendor])
            ->andFilterWhere(['like', 'offering_letter', $this->offering_letter]);

        return $dataProvider;
    }
}
