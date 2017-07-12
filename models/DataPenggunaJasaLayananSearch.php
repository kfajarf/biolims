<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataPenggunaJasaLayanan;

/**
 * SampelSearch represents the model behind the search form about `app\models\Sampel`.
 */
class DataPenggunaJasaLayananSearch extends DataPenggunaJasaLayanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lpsb_order_no','kategori','nama_lengkap','institusi_perusahaan'], 'safe'],
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
        $query = DataPenggunaJasaLayanan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }

        // grid filtering conditions
        $query->andFilterWhere([
        ]);

        $query
            ->andFilterWhere(['like', 'lpsb_order_no', $this->lpsb_order_no])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'institusi_perusahaan', $this->institusi_perusahaan]);

        return $dataProvider;
    }
}
