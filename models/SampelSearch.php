<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sampel;

/**
 * SampelSearch represents the model behind the search form about `app\models\Sampel`.
 */
class SampelSearch extends Sampel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_sampel', 'jenis', 'kemasan', 'jumlah', 'jenis_metode_analisis', 'request_id'], 'safe'],
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
        $query = Sampel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // $this->load($params);

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }

        // grid filtering conditions
        $query->andFilterWhere([
        ]);

        $query->andFilterWhere(['like', 'nama_sampel', $this->id])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'kemasan', $this->kemasan])
            ->andFilterWhere(['like', 'jumlah', $this->jumlah])
            ->andFilterWhere(['like', 'jenis_metode_analisis', $this->jenis_metode_analisis])
            ->andFilterWhere(['like', 'request_id', $this->request_id]);

        return $dataProvider;
    }
}
