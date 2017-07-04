<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JenisBahan;

/**
 * JenisBahanSearch represents the model behind the search form about `app\models\JenisBahan`.
 */
class JenisBahanSearch extends JenisBahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jenis_bahan'], 'integer'],
            [['jenis_bahan'], 'safe'],
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
        $query = JenisBahan::find();

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
            'id_jenis_bahan' => $this->id_jenis_bahan,
        ]);

        $query->andFilterWhere(['like', 'jenis_bahan', $this->jenis_bahan]);

        return $dataProvider;
    }
}
