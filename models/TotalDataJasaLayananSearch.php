<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TotalDataJasaLayanan;

/**
 * SampelSearch represents the model behind the search form about `app\models\Sampel`.
 */
class TotalDataJasaLayananSearch extends TotalDataJasaLayanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','lpsb_order_no','kategori','nama_lengkap','institusi_perusahaan','alamat','telp_fax','no_hp','email','analisis','sampel_id','nama_sampel','kemasan','jumlah','metode','status_pengujian','tanggal_diterima','tanggal_selesai','total_biaya','dp','sisa','keterangan','status'], 'safe'],
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
        $query = TotalDataJasaLayanan::find();

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
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'lpsb_order_no', $this->lpsb_order_no])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'institusi_perusahaan', $this->institusi_perusahaan])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'telp_fax', $this->telp_fax])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'analisis', $this->analisis])
            ->andFilterWhere(['like', 'sampel_id', $this->sampel_id])
            ->andFilterWhere(['like', 'nama_sampel', $this->nama_sampel])
            ->andFilterWhere(['like', 'kemasan', $this->kemasan])
            ->andFilterWhere(['like', 'jumlah', $this->jumlah])
            ->andFilterWhere(['like', 'metode', $this->metode])
            ->andFilterWhere(['like', 'status_pengujian', $this->status_pengujian])
            ->andFilterWhere(['like', 'tanggal_diterima', $this->tanggal_diterima])
            ->andFilterWhere(['like', 'tanggal_selesai', $this->tanggal_selesai])
            ->andFilterWhere(['like', 'total_biaya', $this->total_biaya])
            ->andFilterWhere(['like', 'dp', $this->dp])
            ->andFilterWhere(['like', 'sisa', $this->sisa])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
