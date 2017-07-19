<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab_kit".
 *
 * @property integer $id
 * @property string $nama_alat
 * @property integer $jangka_kalibrasi
 * @property string $tanggal_mulai
 * @property string $kalibrasi_selanjutnya
 * @property string $status_penggunaan
 *
 * @property PenggunaanAlat[] $penggunaanAlats
 */
class LabKit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lab_kit';
    }

    /**
     * @inheritdoc
     */

    public $keterangan;

    public function rules()
    {
        return [
            [['nama_alat', 'jangka_kalibrasi', 'tanggal_mulai'], 'required'],
            [['jangka_kalibrasi', 'kalibrasi_per_hari'], 'integer'],
            [['status_penggunaan'], 'default' , 'value' => 'tersedia'],
            [['status_kalibrasi'], 'default' , 'value' => 'sudah dikalibrasi'],
            [['tanggal_mulai', 'kalibrasi_selanjutnya', 'keterangan', 'status_kalibrasi'], 'safe'],
            [['status_penggunaan'], 'string'],
            [['nama_alat'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_alat' => 'Nama Alat',
            'jangka_kalibrasi' => 'Jangka Kalibrasi',
            'tanggal_mulai' => 'Tanggal Mulai',
            'kalibrasi_selanjutnya' => 'Kalibrasi Selanjutnya',
            'status_penggunaan' => 'Status Penggunaan',
            'status_kalibrasi' => 'Status Kalibrasi',
            'kalibrasi_per_hari' => 'Kalibrasi hari ini',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenggunaanAlats()
    {
        return $this->hasMany(PenggunaanAlat::className(), ['kit_id' => 'id']);
    }
}
