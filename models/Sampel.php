<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sampel".
 *
 * @property integer $id
 * @property string $nama_sampel
 * @property integer $id_jenis
 * @property string $kemasan
 * @property string $jumlah
 * @property string $jenis_metode_analisis
 * @property integer $request_id
 *
 * @property AnalysisRequest $request
 * @property JenisAnalisis $idJenis
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
            [['sampel_id', 'nama_sampel', 'id_jenis', 'kemasan', 'jumlah'], 'required'],
            [['id_jenis', 'request_id'], 'integer'],
            [['jenis_metode_analisis'], 'safe'],
            [['nama_sampel', 'kemasan', 'jumlah', 'jenis_metode_analisis', 'sampel_id'], 'string', 'max' => 100],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnalysisRequest::className(), 'targetAttribute' => ['request_id' => 'id']],
            [['id_jenis'], 'exist', 'skipOnError' => true, 'targetClass' => JenisAnalisis::className(), 'targetAttribute' => ['id_jenis' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sampel_id' => 'Sampel ID',
            'nama_sampel' => 'Nama Sampel',
            'id_jenis' => 'Jenis',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'jenis_metode_analisis' => 'Jenis Metode Analisis',
            'request_id' => 'Request ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(AnalysisRequest::className(), ['id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenis()
    {
        return $this->hasOne(JenisAnalisis::className(), ['id' => 'id_jenis']);
    }
}
