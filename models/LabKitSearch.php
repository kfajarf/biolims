<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LabKit;

/**
 * LabKitSearch represents the model behind the search form about `app\models\LabKit`.
 */
class LabKitSearch extends LabKit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jangka_kalibrasi'], 'integer'],
            [['nama_alat', 'tanggal_mulai', 'kalibrasi_selanjutnya', 'status_penggunaan','status_kalibrasi'], 'safe'],
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
        $query = LabKit::find();

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
            'id' => $this->id,
            'jangka_kalibrasi' => $this->jangka_kalibrasi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'kalibrasi_selanjutnya' => $this->kalibrasi_selanjutnya,
        ]);

        $query->andFilterWhere(['like', 'nama_alat', $this->nama_alat])
            ->andFilterWhere(['like', 'status_penggunaan', $this->status_penggunaan])
            ->andFilterWhere(['like', 'status_kalibrasi', $this->status_kalibrasi]);

        return $dataProvider;
    }
}
