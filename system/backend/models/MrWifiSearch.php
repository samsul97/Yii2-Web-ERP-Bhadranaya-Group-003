<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MrWifi;

/**
 * MrWifiSearch represents the model behind the search form of `backend\models\MrWifi`.
 */
class MrWifiSearch extends MrWifi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'url', 'vendor', 'ssid', 'username_modem', 'pasword_modem', 'username_login', 'password_login', 'speed'], 'safe'],
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
        $query = MrWifi::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'vendor', $this->vendor])
            ->andFilterWhere(['like', 'ssid', $this->ssid])
            ->andFilterWhere(['like', 'username_modem', $this->username_modem])
            ->andFilterWhere(['like', 'pasword_modem', $this->pasword_modem])
            ->andFilterWhere(['like', 'username_login', $this->username_login])
            ->andFilterWhere(['like', 'password_login', $this->password_login])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return $dataProvider;
    }
}
