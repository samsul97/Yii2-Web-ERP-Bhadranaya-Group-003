<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MrTkp;

/**
 * MrTkpSearch represents the model behind the search form of `backend\models\MrTkp`.
 */
class MrTkpSearch extends MrTkp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_company', 'code_location', 'id_cctv', 'id_wifi', 'status'], 'integer'],
            [['name', 'code', 'alamat', 'responbilities', 'no_hp', 'telp', 'ip_viewer', 'ip_pos1', 'ip_pos2', 'ip_pos3', 'ip_kitchen', 'ip_bar', 'ip_public', 'ip_office', 'ip_mikrotik', 'pass_mikrotik', 'user_mikrotik', 'created_at'], 'safe'],
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
        $query = MrTkp::find();

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
            'id_company' => $this->id_company,
            'code_location' => $this->code_location,
            'id_cctv' => $this->id_cctv,
            'id_wifi' => $this->id_wifi,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'responbilities', $this->responbilities])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'ip_viewer', $this->ip_viewer])
            ->andFilterWhere(['like', 'ip_pos1', $this->ip_pos1])
            ->andFilterWhere(['like', 'ip_pos2', $this->ip_pos2])
            ->andFilterWhere(['like', 'ip_pos3', $this->ip_pos3])
            ->andFilterWhere(['like', 'ip_kitchen', $this->ip_kitchen])
            ->andFilterWhere(['like', 'ip_bar', $this->ip_bar])
            ->andFilterWhere(['like', 'ip_public', $this->ip_public])
            ->andFilterWhere(['like', 'ip_office', $this->ip_office])
            ->andFilterWhere(['like', 'ip_mikrotik', $this->ip_mikrotik])
            ->andFilterWhere(['like', 'pass_mikrotik', $this->pass_mikrotik])
            ->andFilterWhere(['like', 'user_mikrotik', $this->user_mikrotik]);

        return $dataProvider;
    }
}
