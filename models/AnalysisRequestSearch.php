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

    public $nama_lengkap, $institusi_perusahaan, $alamat, $telp_fax, $no_hp, $email;
    public function rules()
    {
        return [
            [['lpsb_order_no', 'status_pengujian', 'tanggal_diterima', 'tanggal_selesai', 'keterangan', 'nama_lengkap', 'institusi_perusahaan', 'alamat', 'telp_fax', 'no_hp', 'email'], 'safe'],
            [['total_biaya', 'dp', 'sisa'], 'integer'],
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
        $query -> joinWith('pemohonAnalisis');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['tanggal_selesai' => SORT_ASC]],
        ]);
        
        $dataProvider -> sort -> attributes['nama_lengkap'] = [
                    'asc' => ['pemohon_analisis.nama_lengkap' => SORT_ASC],
                    'desc' => ['pemohon_analisis.nama_lengkap' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['institusi_perusahaan'] = [
                    'asc' => ['pemohon_analisis.institusi_perusahaan' => SORT_ASC],
                    'desc' => ['pemohon_analisis.institusi_perusahaan' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['alamat'] = [
                    'asc' => ['pemohon_analisis.alamat' => SORT_ASC],
                    'desc' => ['pemohon_analisis.alamat' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['telp_fax'] = [
                    'asc' => ['pemohon_analisis.telp_fax' => SORT_ASC],
                    'desc' => ['pemohon_analisis.telp_fax' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['no_hp'] = [
                    'asc' => ['pemohon_analisis.no_hp' => SORT_ASC],
                    'desc' => ['pemohon_analisis.no_hp' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['email'] = [
                    'asc' => ['pemohon_analisis.email' => SORT_ASC],
                    'desc' => ['pemohon_analisis.email' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'total_biaya' => $this->total_biaya,
            'dp' => $this->dp,
            'sisa' => $this->sisa,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'lpsb_order_no', $this->lpsb_order_no])
            ->andFilterWhere(['like', 'status_pengujian', $this->status_pengujian])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'tanggal_diterima', $this->tanggal_diterima])
            ->andFilterWhere(['like', 'pemohon_analisis.nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'pemohon_analisis.institusi_perusahaan', $this->institusi_perusahaan])
            ->andFilterWhere(['like', 'pemohon_analisis.alamat', $this->alamat])
            ->andFilterWhere(['like', 'pemohon_analisis.telp_fax', $this->telp_fax])
            ->andFilterWhere(['like', 'pemohon_analisis.no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'pemohon_analisis.email', $this->email]);

        return $dataProvider;
    }
}
