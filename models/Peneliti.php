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
 * @property integer $departemen_id
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
 * @property Departemen $departemen
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
            [['nama_lengkap', 'tempat_tanggal_lahir', 'institusi', 'departemen_id', 'nrp_nim', 'no_handphone', 'email', 'judul_penelitian', 'tanggal_masuk_lpsb'], 'required'],
            [['departemen_id', 'uang_masuk_lpsb', 'deposit_lpsb', 'biaya_hasil_rekapitulasi'], 'integer'],
            [['tanggal_masuk_lpsb','id','alamat_dan_no_telp_bogor', 'alamat_dan_no_telp_orang_tua', 'uang_masuk_lpsb', 'deposit_lpsb', 'keterangan', 'status'], 'safe'],
            [['alamat_dan_no_telp_bogor', 'alamat_dan_no_telp_orang_tua', 'keterangan'], 'default', 'value' => '-'],
            [['uang_masuk_lpsb', 'deposit_lpsb'], 'default', 'value' => 0],
            ['email', 'email'],
            [['nama_lengkap', 'tempat_tanggal_lahir', 'institusi', 'nrp_nim', 'no_handphone', 'email', 'alamat_dan_no_telp_bogor', 'alamat_dan_no_telp_orang_tua', 'judul_penelitian', 'keterangan'], 'string', 'max' => 100],
            [['departemen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departemen::className(), 'targetAttribute' => ['departemen_id' => 'id']],
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
            'departemen_id' => 'Departemen',
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
            'status' => 'Status',
            'biaya_hasil_rekapitulasi' => 'Total Biaya',
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
    public function getPembimbingPenelitian()
    {
        return $this->hasMany(PembimbingPenelitian::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartemen()
    {
        return $this->hasOne(Departemen::className(), ['id' => 'departemen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekapitulasiBahan()
    {
        return $this->hasMany(RekapitulasiBahan::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampelInvoice()
    {
        return $this->hasMany(SampelInvoice::className(), ['id_peneliti' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTempatPenelitianLain()
    {
        return $this->hasMany(TempatPenelitianLain::className(), ['id_peneliti' => 'id']);
    }

    public function getNamaPembimbing()
    {
        $texts = [];
        foreach($this->pembimbingPenelitian as $pembimbing) {
            $texts[] = $pembimbing->nama_pembimbing;
        }
        return implode(" & ", $texts);
    }

    public function getNamaTempat()
    {
        $texts = [];
        foreach($this->tempatPenelitianLain as $tempat) {
            $texts[] = $tempat->nama_tempat;
        }
        return implode(" & ", $texts);
    }
}
