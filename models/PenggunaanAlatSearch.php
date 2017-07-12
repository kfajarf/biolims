<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenggunaanAlat;

/**
 * PenggunaanAlatSearch represents the model behind the search form about `app\models\PenggunaanAlat`.
 */
class PenggunaanAlatSearch extends PenggunaanAlat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kit_id'], 'integer'],
            [['nama_pengguna', 'nim', 'tanggal_penggunaan', 'status_pengembalian_alat'], 'safe'],
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
        $query = PenggunaanAlat::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['tanggal_penggunaan' => SORT_DESC]],
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
            'kit_id' => $this->kit_id,
            'tanggal_penggunaan' => $this->tanggal_penggunaan,
        ]);

        $query->andFilterWhere(['like', 'nama_pengguna', $this->nama_pengguna])
            ->andFilterWhere(['like', 'nim', $this->nim])
            ->andFilterWhere(['like', 'status_pengembalian_alat', $this->status_pengembalian_alat]);

        return $dataProvider;
    }
}
