<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnalysisRequestData;

/**
 * AnalysisRequestDataSearch represents the model behind the search form about `app\models\AnalysisRequestData`.
 */
class AnalysisRequestDataSearch extends AnalysisRequestData
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
           	[['id', 'total_biaya', 'dp', 'sisa', 'jumlah'], 'integer'],
            [['lpsb_order_no','kategori', 'nama_sampel', 'jenis', 'kemasan', 'jenis_metode_analisis', 'status_pengujian', 'tanggal_diterima', 'tanggal_selesai', 'total_biaya', 'dp', 'sisa', 'keterangan', 'status_pengujian', 'keterangan', 'tanggal_diterima', 'tanggal_selesai'], 'safe'],
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
        $query = AnalysisRequestData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['tanggal_selesai' => SORT_ASC]],
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
            'total_biaya' => $this->total_biaya,
            'dp' => $this->dp,
            'sisa' => $this->sisa,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'lpsb_order_no', $this->lpsb_order_no])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'nama_sampel', $this->nama_sampel])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'kemasan', $this->kemasan])
            ->andFilterWhere(['like', 'jenis_metode_analisis', $this->jenis_metode_analisis])
            ->andFilterWhere(['like', 'status_pengujian', $this->status_pengujian])
            ->andFilterWhere(['like', 'tanggal_diterima', $this->tanggal_diterima])
            ->andFilterWhere(['like', 'tanggal_selesai', $this->tanggal_selesai])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
