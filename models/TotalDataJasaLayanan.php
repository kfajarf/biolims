<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "total_data_jasa_layanan".
 *
 * @property integer $id
 * @property string $lpsb_order_no
 * @property string $kategori
 * @property string $nama_lengkap
 * @property string $institusi_perusahaan
 * @property string $alamat
 * @property string $telp_fax
 * @property string $no_hp
 * @property string $email
 * @property string $analisis
 * @property string $sampel_id
 * @property string $nama_sampel
 * @property string $kemasan
 * @property integer $jumlah
 * @property string $metode
 * @property string $status_pengujian
 * @property string $tanggal_diterima
 * @property string $tanggal_selesai
 * @property integer $total_biaya
 * @property integer $dp
 * @property integer $sisa
 * @property string $keterangan
 * @property string $status
 */
class TotalDataJasaLayanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'total_data_jasa_layanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jumlah', 'total_biaya', 'dp', 'sisa'], 'integer'],
            [['alamat', 'keterangan'], 'string'],
            [['tanggal_diterima', 'tanggal_selesai'], 'safe'],
            [['lpsb_order_no', 'kategori', 'nama_lengkap', 'institusi_perusahaan', 'telp_fax', 'no_hp', 'email', 'analisis', 'sampel_id', 'nama_sampel', 'kemasan', 'metode'], 'string', 'max' => 100],
            [['status_pengujian'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 11],
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
            'nama_lengkap' => 'Nama Lengkap',
            'institusi_perusahaan' => 'Institusi Perusahaan',
            'alamat' => 'Alamat',
            'telp_fax' => 'Telp Fax',
            'no_hp' => 'No Hp',
            'email' => 'Email',
            'analisis' => 'Analisis',
            'sampel_id' => 'Sampel ID',
            'nama_sampel' => 'Nama Sampel',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'metode' => 'Metode',
            'status_pengujian' => 'Status Pengujian',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
            'total_biaya' => 'Total Biaya',
            'dp' => 'Dp',
            'sisa' => 'Sisa',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
        ];
    }
}
