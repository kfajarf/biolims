<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnalysisRequest;

/**
 * AnalysisRequestSearch represents the model behind the search form about `app\models\AnalysisRequest`.
 */
class AnalysisRequestSearch extends AnalysisRequest
{
    /**
     * @inheritdoc
     */
    public $nama;
    public $institusi;
    public $alamat;
    public $telp_fax;
    public $no_hp;
    public $email;
    public $nama_sampel;
    public $jenis_sampel;
    public $kemasan;
    public $jumlah;
    public $jenis_metode_analisis;
    public $status_pengujian;
    public $tanggal_selesai;

    public function rules()
    {
        return [
            [['lpsb_order_no', 'nama', 'institusi', 'alamat', 'telp_fax', 'no_hp', 'email', 'nama_sampel', 'jenis_sampel', 'kemasan', 'jumlah', 'jenis_metode_analisis', 'status_pengujian', 'tanggal_selesai', 'tanggal_diterima', 'id_sampel'], 'safe'],
            [['id_pemohon', 'id_pengujian', 'total_biaya', 'dp', 'sisa'], 'integer'],
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
        $query = AnalysisRequest::find();

        // add conditions that should always apply here
        $query -> joinWith('pemohon', 'sampel');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider -> sort -> attributes['nama'] = [
            'asc' => ['pemohon.nama' => SORT_ASC],
            'desc' => ['pemohon.nama' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['institusi'] = [
            'asc' => ['pemohon.institusi' => SORT_ASC],
            'desc' => ['pemohon.institusi' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['alamat'] = [
            'asc' => ['pemohon.alamat' => SORT_ASC],
            'desc' => ['pemohon.alamat' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['telp_fax'] = [
            'asc' => ['pemohon.telp_fax' => SORT_ASC],
            'desc' => ['pemohon.telp_fax' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['no_hp'] = [
            'asc' => ['pemohon.no_hp' => SORT_ASC],
            'desc' => ['pemohon.no_hp' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['email'] = [
            'asc' => ['pemohon.email' => SORT_ASC],
            'desc' => ['pemohon.email' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['nama_sampel'] = [
            'asc' => ['sampel.nama_sampel' => SORT_ASC],
            'desc' => ['sampel.nama_sampel' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['jenis_sampel'] = [
            'asc' => ['sampel.jenis_sampel' => SORT_ASC],
            'desc' => ['sampel.jenis_sampel' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['kemasan'] = [
            'asc' => ['sampel.kemasan' => SORT_ASC],
            'desc' => ['sampel.kemasan' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['jumlah'] = [
            'asc' => ['sampel.jumlah' => SORT_ASC],
            'desc' => ['sampel.jumlah' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['jenis_metode_analisis'] = [
            'asc' => ['sampel.jenis_metode_analisis' => SORT_ASC],
            'desc' => ['sampel.jenis_metode_analisis' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['status_pengujian'] = [
            'asc' => ['pengujian.status_pengujian' => SORT_ASC],
            'desc' => ['pengujian.status_pengujian' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['tanggal_selesai'] = [
            'asc' => ['pengujian.tanggal_selesai' => SORT_ASC],
            'desc' => ['pengujian.tanggal_selesai' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pemohon' => $this->id_pemohon,
            'id_pengujian' => $this->id_pengujian,
            'total_biaya' => $this->total_biaya,
            'dp' => $this->dp,
            'sisa' => $this->sisa,
            'tanggal_diterima' => $this->tanggal_diterima,
        ]);

        $query->andFilterWhere(['like', 'lpsb_order_no', $this->lpsb_order_no])
            ->andFilterWhere(['like', 'pemohon.nama', $this->nama])
            ->andFilterWhere(['like', 'pemohon.institusi', $this->institusi])
            ->andFilterWhere(['like', 'pemohon.alamat', $this->alamat])
            ->andFilterWhere(['like', 'pemohon.telp_fax', $this->telp_fax])
            ->andFilterWhere(['like', 'pemohon.no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'pemohon.email', $this->email])
            ->andFilterWhere(['like', 'sampel.nama_sampel', $this->nama_sampel])
            ->andFilterWhere(['like', 'sampel.jenis_sampel', $this->jenis_sampel])
            ->andFilterWhere(['like', 'sampel.kemasan', $this->kemasan])
            ->andFilterWhere(['like', 'sampel.jumlah', $this->jumlah])
            ->andFilterWhere(['like', 'sampel.jenis_metode_analisis', $this->jenis_metode_analisis])
            ->andFilterWhere(['like', 'reagen.status_pengujian', $this->status_pengujian])
            ->andFilterWhere(['like', 'reagen.tanggal_selesai', $this->tanggal_selesai])
            ->andFilterWhere(['like', 'id_sampel', $this->id_sampel]);

        return $dataProvider;
    }
}
