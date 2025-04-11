<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TbAssetsMove;

/**
 * TbAssetsMoveSearch represents the model behind the search form of `backend\models\TbAssetsMove`.
 */
class TbAssetsMoveSearch extends TbAssetsMove
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tb_assets', 'id_user', 'id_tkp', 'id_tkp_origin', 'qty_move'], 'integer'],
            [['name', 'dom', 'timestamp'], 'safe'],
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
        $query = TbAssetsMove::find();

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
            'id_tkp' => $this->id_tkp,
            'id_tkp_origin' => $this->id_tkp_origin,
            'qty_move' => $this->qty_move,
            'dom' => $this->dom,
            'timestamp' => $this->timestamp,
        ]);

        // $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
