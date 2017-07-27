<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TakeReagen;

/**
 * AnalysisRequestDataSearch represents the model behind the search form about `app\models\AnalysisRequestData`.
 */
class TakeReagenSearch extends TakeReagen
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
           	[['id', 'chem_storage_id', 'jumlah'], 'integer'],
            [['id_reagen', 'nama_reagen', 'tanggal_pengambilan', 'chem_storage_id', 'nama_pengambil', 'unit'], 'safe'],
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
    public function search($params, $id)
    {
        $query = TakeReagen::find();

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
            'chem_storage_id' => $this->chem_storage_id,
        ]);

        $query->andFilterWhere(['like', 'id_reagen', $id])
            ->andFilterWhere(['like', 'nama_pengambil', $this->nama_pengambil])
            ->andFilterWhere(['like', 'nama_reagen', $this->nama_reagen])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'tanggal_pengambilan', $this->tanggal_pengambilan]);

        return $dataProvider;
    }
}
