<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frekuensi_jasa_layanan_per_bulan".
 *
 * @property integer $tahun
 * @property string $bulan
 * @property string $jumlah
 */
class FrekuensiJasaLayananPerBulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frekuensi_jasa_layanan_per_bulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'jumlah'], 'integer'],
            [['bulan'], 'string', 'max' => 9],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tahun' => 'Tahun',
            'bulan' => 'Bulan',
            'jumlah' => 'Jumlah',
        ];
    }
}
