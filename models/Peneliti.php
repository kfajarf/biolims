<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peneliti".
 *
 * @property integer $id
 * @property string $nama_lengkap
 * @property string $tempat_tanggal_lahir
 * @property string $institusi
 * @property string $nrp_nim
 * @property string $no_handphone
 * @property string $email
 * @property string $alamat_dan_no_telp_bogor
 * @property string $alamat_dan_no_telp_orang_tua
 * @property string $judul_penelitian
 * @property string $tanggal_masuk_lpsb
 * @property integer $uang_masuk_lpsb
 * @property integer $deposit_lpsb
 * @property string $keterangan
 * @property integer $biaya_hasil_rekapitulasi
 *
 * @property Invoice[] $invoices
 * @property PembimbingPenelitian[] $pembimbingPenelitians
 * @property RekapitulasiBahan[] $rekapitulasiBahans
 * @property SampelPenelitian[] $sampelPenelitians
 * @property TempatPenelitianLain[] $tempatPenelitianLains
 */
class Peneliti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peneliti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_lengkap', 'tempat_tanggal_lahir', 'institusi', 'nrp_nim', 'no_handphone', 'email', 'alamat_dan_no_telp_bogor', 'alamat_dan_no_telp_orang_tua', 'judul_penelitian', 'tanggal_masuk_lpsb', 'uang_masuk_lpsb', 'deposit_lpsb', 'keterangan'], 'required'],
            [['tanggal_masuk_lpsb'], 'safe'],
            [['uang_masuk_lpsb', 'deposit_lpsb', 'biaya_hasil_rekapitulasi'], 'integer'],
            [['nama_lengkap', 'tempat_tanggal_lahir', 'institusi', 'nrp_nim', 'no_handphone', 'email', 'alamat_dan_no_telp_bogor', 'alamat_dan_no_telp_orang_tua', 'judul_penelitian', 'keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_lengkap' => 'Nama Lengkap',
            'tempat_tanggal_lahir' => 'Tempat Tanggal Lahir',
            'institusi' => 'Institusi',
            'nrp_nim' => 'Nrp Nim',
            'no_handphone' => 'No Handphone',
            'email' => 'Email',
            'alamat_dan_no_telp_bogor' => 'Alamat Dan No Telp Bogor',
            'alamat_dan_no_telp_orang_tua' => 'Alamat Dan No Telp Orang Tua',
            'judul_penelitian' => 'Judul Penelitian',
            'tanggal_masuk_lpsb' => 'Tanggal Masuk Lpsb',
            'uang_masuk_lpsb' => 'Uang Masuk Lpsb',
            'deposit_lpsb' => 'Deposit Lpsb',
            'keterangan' => 'Keterangan',
            'biaya_hasil_rekapitulasi' => 'Biaya Hasil Rekapitulasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembimbingPenelitians()
    {
        return $this->hasMany(PembimbingPenelitian::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekapitulasiBahans()
    {
        return $this->hasMany(RekapitulasiBahan::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampelPenelitians()
    {
        return $this->hasMany(SampelPenelitian::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTempatPenelitianLains()
    {
        return $this->hasMany(TempatPenelitianLain::className(), ['id_peneliti' => 'id']);
    }
}
