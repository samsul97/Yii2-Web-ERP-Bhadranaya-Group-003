<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tbemptkpops;

/**
 * MpGradeSearch represents the model behind the search form of `backend\models\Tbemptkpops`.
 */
class MpGradeSearch extends Tbemptkpops
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tkp_from', 'id_tkp_destination', 'id_user'], 'integer'],
            [['no_receipt', 'pic', 'necessity', 'note', 'deadline', 'created_at'], 'safe'],
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
        $query = Tbemptkpops::find();

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
            'id_tkp_from' => $this->id_tkp_from,
            'id_tkp_destination' => $this->id_tkp_destination,
            'id_user' => $this->id_user,
            'deadline' => $this->deadline,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'no_receipt', $this->no_receipt])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'necessity', $this->necessity])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
