<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reagen;
use app\models\ChemStorage;
use app\models\Lokasi;
use app\models\Supplier;

/**
 * ReagenSearch represents the model behind the search form about `app\models\Reagen`.
 */
class ReagenSearch extends Reagen
{
    /**
     * @inheritdoc
     */
    public $pemilik;
    public $lokasi_penyimpanan;
    public $supplier;
    public $tanggal_masuk;


    public function rules()
    {
        return [
            [['id_reagen', 'nama_reagen', 'jenis_reagen', 'unit', 'tanggal_kadaluarsa', 'pemilik', 'lokasi_penyimpanan', 'supplier', 'id_lokasi', 'id_supplier', 'id_storage', 'tanggal_masuk'], 'safe'],
            [['jumlah', 'jumlah_minimum'], 'number'],
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
        $query = Reagen::find();

        // add conditions that should always apply here
        $query -> joinWith(['lokasi']);
        $query -> joinWith(['supplier']);
        $query -> joinWith(['chemStorage']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['tanggal_kadaluarsa' => SORT_ASC]],
        ]);

        $dataProvider -> sort -> attributes['lokasi_penyimpanan'] = [
                    'asc' => ['lokasi.lokasi_penyimpanan' => SORT_ASC],
                    'desc' => ['lokasi.lokasi_penyimpanan' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['supplier'] = [
                    'asc' => ['supplier.supplier' => SORT_ASC],
                    'desc' => ['supplier.supplier' => SORT_DESC],
        ];


        $dataProvider -> sort -> attributes['pemilik'] = [
                    'asc' => ['chem_storage.pemilik' => SORT_ASC],
                    'desc' => ['chem_storage.pemilik' => SORT_DESC],
        ];

        $dataProvider -> sort -> attributes['tanggal_masuk'] = [
                    'asc' => ['chem_storage.tanggal_masuk' => SORT_ASC],
                    'desc' => ['chem_storage.tanggal_masuk' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'jumlah' => $this->jumlah,
            'jumlah_minimum' => $this->jumlah_minimum,
            'id_lokasi' => $this->id_lokasi,
            'id_supplier' => $this->id_supplier,
            'id_storage' => $this->id_storage,
        ]);

        $query->andFilterWhere(['like', 'id_reagen', $this->id_reagen])
            ->andFilterWhere(['like', 'nama_reagen', $this->nama_reagen])
            ->andFilterWhere(['like', 'jenis_reagen', $this->jenis_reagen])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'tanggal_kadaluarsa', $this->tanggal_kadaluarsa,])
            ->andFilterWhere(['like', 'lokasi.lokasi_penyimpanan', $this->lokasi_penyimpanan])
            ->andFilterWhere(['like', 'supplier.supplier', $this->supplier])
            ->andFilterWhere(['like', 'chem_storage.pemilik', $this->pemilik])
            ->andFilterWhere(['like', 'chem_storage.tanggal_masuk', $this->tanggal_masuk])
            ;

        return $dataProvider;
    }
}
