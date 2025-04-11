<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SetBeView;

/**
 * SetBeViewSearch represents the model behind the search form of `backend\models\SetBeView`.
 */
class SetBeViewSearch extends SetBeView
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['header_side_logo', 'header_side_color', 'navbar_main_color', 'navbar_btn_color', 'sidebar_color', 'footer_color', 'footer_content', 'favicon', 'timestamp'], 'safe'],
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
        $query = SetBeView::find();

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
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'header_side_logo', $this->header_side_logo])
            ->andFilterWhere(['like', 'header_side_color', $this->header_side_color])
            ->andFilterWhere(['like', 'navbar_main_color', $this->navbar_main_color])
            ->andFilterWhere(['like', 'navbar_btn_color', $this->navbar_btn_color])
            ->andFilterWhere(['like', 'sidebar_color', $this->sidebar_color])
            ->andFilterWhere(['like', 'footer_color', $this->footer_color])
            ->andFilterWhere(['like', 'footer_content', $this->footer_content])
            ->andFilterWhere(['like', 'favicon', $this->favicon]);

        return $dataProvider;
    }
}
