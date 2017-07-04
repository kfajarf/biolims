<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reagen;

/**
 * ReagenSearch represents the model behind the search form about `app\models\Reagen`.
 */
class ReagenSearch extends Reagen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bahan', 'nama_bahan', 'jenis_bahan', 'unit', 'tanggal_kadaluarsa', 'status'], 'safe'],
            [['jumlah', 'jumlah_minimum', 'id_lokasi', 'id_supplier', 'id_storage'], 'integer'],
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
            'jumlah' => $this->jumlah,
            'jumlah_minimum' => $this->jumlah_minimum,
            'tanggal_kadaluarsa' => $this->tanggal_kadaluarsa,
            'id_lokasi' => $this->id_lokasi,
            'id_supplier' => $this->id_supplier,
            'id_storage' => $this->id_storage,
        ]);

        $query->andFilterWhere(['like', 'id_bahan', $this->id_bahan])
            ->andFilterWhere(['like', 'nama_bahan', $this->nama_bahan])
            ->andFilterWhere(['like', 'jenis_bahan', $this->jenis_bahan])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
