<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SetFeHeader;

/**
 * SetFeHeaderSearch represents the model behind the search form of `backend\models\SetFeHeader`.
 */
class SetFeHeaderSearch extends SetFeHeader
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'social_proof_status', 'pause_social_proof', 'time_social_proof'], 'integer'],
            [['name', 'contact', 'logo', 'logo_dark', 'favicon', 'navbar_color', 'btn_color', 'timestamp'], 'safe'],
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
        $query = SetFeHeader::find();

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
            'social_proof_status' => $this->social_proof_status,
            'pause_social_proof' => $this->pause_social_proof,
            'time_social_proof' => $this->time_social_proof,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'logo_dark', $this->logo_dark])
            ->andFilterWhere(['like', 'favicon', $this->favicon])
            ->andFilterWhere(['like', 'navbar_color', $this->navbar_color])
            ->andFilterWhere(['like', 'btn_color', $this->btn_color]);

        return $dataProvider;
    }
}
