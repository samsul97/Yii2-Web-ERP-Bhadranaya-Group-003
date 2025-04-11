<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbEmpLeave;

/**
 * TbEmpLeaveSearch represents the model behind the search form of `backend\models\TbEmpLeave`.
 */
class TbEmpLeaveSearch extends TbEmpLeave
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_employee'], 'integer'],
            [['leave_type', 'start_date', 'till_date', 'reason', 'dof', 'timestamp'], 'safe'],
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
        $query = TbEmpLeave::find();

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
            'id_employee' => $this->id_employee,
            // 'leave_total' => $this->leave_total,
            'start_date' => $this->start_date,
            'till_date' => $this->till_date,
            'dof' => $this->dof,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'leave_type', $this->leave_type])
            ->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
