<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Peneliti;

/**
 * PenelitiSearch represents the model behind the search form about `app\models\Peneliti`.
 */
class PenelitiSearch extends Peneliti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'departemen_id', 'uang_masuk_lpsb', 'deposit_lpsb', 'biaya_hasil_rekapitulasi'], 'integer'],
            [['nama_lengkap', 'tempat_tanggal_lahir', 'institusi', 'nrp_nim', 'no_handphone', 'email', 'alamat_dan_no_telp_bogor', 'alamat_dan_no_telp_orang_tua', 'judul_penelitian', 'tanggal_masuk_lpsb', 'keterangan', 'status'], 'safe'],
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
        $query = Peneliti::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['status' => SORT_DESC, 'tanggal_masuk_lpsb' => SORT_DESC]],
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
            'departemen_id' => $this->departemen_id,
            'tanggal_masuk_lpsb' => $this->tanggal_masuk_lpsb,
            'uang_masuk_lpsb' => $this->uang_masuk_lpsb,
            'deposit_lpsb' => $this->deposit_lpsb,
            'biaya_hasil_rekapitulasi' => $this->biaya_hasil_rekapitulasi,
        ]);

        $query->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'tempat_tanggal_lahir', $this->tempat_tanggal_lahir])
            ->andFilterWhere(['like', 'institusi', $this->institusi])
            ->andFilterWhere(['like', 'nrp_nim', $this->nrp_nim])
            ->andFilterWhere(['like', 'no_handphone', $this->no_handphone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'alamat_dan_no_telp_bogor', $this->alamat_dan_no_telp_bogor])
            ->andFilterWhere(['like', 'alamat_dan_no_telp_orang_tua', $this->alamat_dan_no_telp_orang_tua])
            ->andFilterWhere(['like', 'judul_penelitian', $this->judul_penelitian])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
