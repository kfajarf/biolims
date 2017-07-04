<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LamaPengujian;

/**
 * LamaPengujianSearch represents the model behind the search form about `app\models\LamaPengujian`.
 */
class LamaPengujianSearch extends LamaPengujian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pengujian'], 'integer'],
            [['status_pengujian', 'tanggal_diterima', 'tanggal_selesai'], 'safe'],
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
        $query = LamaPengujian::find();

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
            'id_pengujian' => $this->id_pengujian,
            'tanggal_diterima' => $this->tanggal_diterima,
            'tanggal_selesai' => $this->tanggal_selesai,
        ]);

        $query->andFilterWhere(['like', 'status_pengujian', $this->status_pengujian]);

        return $dataProvider;
    }
}
