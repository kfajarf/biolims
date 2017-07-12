<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FrekuensiFakultas;

/**
 * SampelSearch represents the model behind the search form about `app\models\Sampel`.
 */
class FrekuensiFakultasSearch extends FrekuensiFakultas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_fakultas', 'jumlah'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = FrekuensiFakultas::find();

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
        ]);

        $query
            ->andFilterWhere(['like', 'nama_fakultas', $this->nama_fakultas])
            ->andFilterWhere(['like', 'jumlah', $this->jumlah]);

        return $dataProvider;
    }
}
