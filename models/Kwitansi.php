<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kwitansi".
 *
 * @property integer $id
 * @property string $no_kwitansi
 * @property string $telah_terima_dari
 * @property string $untuk_pembayaran_analisis
 * @property string $terbilang
 * @property integer $jumlah_biaya
 * @property string $tanggal_kwitansi
 * @property integer $id_peneliti
 */
class Kwitansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kwitansi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_kwitansi', 'telah_terima_dari', 'untuk_pembayaran_analisis', 'terbilang', 'jumlah_biaya', 'tanggal_kwitansi', 'id_peneliti'], 'required'],
            [['jumlah_biaya', 'id_peneliti'], 'integer'],
            [['tanggal_kwitansi'], 'safe'],
            [['no_kwitansi', 'telah_terima_dari', 'untuk_pembayaran_analisis', 'terbilang'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_kwitansi' => 'No Kwitansi',
            'telah_terima_dari' => 'Telah Terima Dari',
            'untuk_pembayaran_analisis' => 'Untuk Pembayaran Analisis',
            'terbilang' => 'Terbilang',
            'jumlah_biaya' => 'Jumlah Biaya',
            'tanggal_kwitansi' => 'Tanggal Kwitansi',
            'id_peneliti' => 'Id Peneliti',
        ];
    }
}
