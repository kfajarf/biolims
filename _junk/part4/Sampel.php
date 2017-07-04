<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sampel".
 *
 * @property string $id_sampel
 * @property string $nama_sampel
 * @property string $jenis_sampel
 * @property string $kemasan
 * @property integer $jumlah
 * @property string $jenis_metode_analisis
 *
 * @property AnalysisRequest[] $analysisRequests
 */
class Sampel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sampel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sampel', 'nama_sampel', 'jenis_sampel', 'kemasan', 'jumlah', 'jenis_metode_analisis'], 'required'],
            [['jumlah'], 'integer'],
            [['id_sampel', 'jenis_sampel', 'kemasan'], 'string', 'max' => 100],
            [['nama_sampel', 'jenis_metode_analisis'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sampel' => 'Id Sampel',
            'nama_sampel' => 'Nama Sampel',
            'jenis_sampel' => 'Jenis Sampel',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'jenis_metode_analisis' => 'Jenis Metode Analisis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalysisRequests()
    {
        return $this->hasMany(AnalysisRequest::className(), ['id_sampel' => 'id_sampel']);
    }
}
