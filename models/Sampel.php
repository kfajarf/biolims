<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sampel".
 *
 * @property string $id
 * @property string $jenis
 * @property string $kemasan
 * @property string $jumlah
 * @property string $jenis_metode_analisis
 * @property string $lpsb_order_no
 *
 * @property AnalysisRequest $lpsbOrderNo
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
            [['nama_sampel', 'jenis', 'kemasan', 'jumlah', 'jenis_metode_analisis'], 'required'],
            [['request_id'], 'integer'],
            [['nama_sampel', 'jenis', 'kemasan', 'jumlah', 'jenis_metode_analisis'], 'string', 'max' => 100],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnalysisRequest::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nama_sampel' => 'ID Sampel',
            'jenis' => 'Jenis',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'jenis_metode_analisis' => 'Jenis Metode Analisis',
            'request_id' => 'Lpsb Order No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpsbOrderNo()
    {
        return $this->hasOne(AnalysisRequest::className(), ['id' => 'request_id']);
    }
}
