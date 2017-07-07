<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis_request_data".
 *
 * @property integer $id
 * @property string $lpsb_order_no
 * @property string $kategori
 * @property string $nama_sampel
 * @property string $jenis
 * @property string $kemasan
 * @property string $jumlah
 * @property string $jenis_metode_analisis
 * @property string $status_pengujian
 * @property string $tanggal_diterima
 * @property string $tanggal_selesai
 * @property integer $total_biaya
 * @property integer $dp
 * @property integer $sisa
 * @property string $keterangan
 */
class AnalysisRequestData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analysis_request_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_biaya', 'dp', 'sisa'], 'integer'],
            [['lpsb_order_no', 'status_pengujian', 'tanggal_diterima', 'tanggal_selesai', 'total_biaya', 'dp', 'sisa', 'keterangan'], 'required'],
            [['status_pengujian', 'keterangan'], 'string'],
            [['tanggal_diterima', 'tanggal_selesai'], 'safe'],
            [['lpsb_order_no', 'kategori', 'nama_sampel', 'jenis', 'kemasan', 'jumlah', 'jenis_metode_analisis'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lpsb_order_no' => 'Lpsb Order No',
            'kategori' => 'Kategori',
            'nama_sampel' => 'Nama Sampel',
            'jenis' => 'Jenis',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'jenis_metode_analisis' => 'Jenis Metode Analisis',
            'status_pengujian' => 'Status Pengujian',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
            'total_biaya' => 'Total Biaya',
            'dp' => 'Dp',
            'sisa' => 'Sisa',
            'keterangan' => 'Keterangan',
        ];
    }
}
