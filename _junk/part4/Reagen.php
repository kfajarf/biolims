<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reagen".
 *
 * @property string $id_bahan
 * @property string $nama_bahan
 * @property string $jenis_bahan
 * @property integer $jumlah
 * @property integer $jumlah_minimum
 * @property string $unit
 * @property string $tanggal_kadaluarsa
 * @property integer $id_lokasi
 * @property integer $id_supplier
 * @property string $status
 * @property integer $id_storage
 *
 * @property ChemStorage $idStorage
 * @property Supplier $idSupplier
 * @property Lokasi $idLokasi
 */
class Reagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bahan', 'nama_bahan', 'jenis_bahan', 'jumlah', 'jumlah_minimum', 'unit', 'tanggal_kadaluarsa', 'id_lokasi', 'id_supplier'], 'required'],
            [['jumlah', 'jumlah_minimum', 'jenis_bahan', 'id_lokasi', 'id_supplier', 'id_storage'], 'integer'],
            [['tanggal_kadaluarsa', 'status'], 'safe'],
            [['id_bahan', 'nama_bahan', 'jenis_bahan', 'status'], 'string', 'max' => 100],
            [['unit'], 'string', 'max' => 20],
            [['id_storage'], 'exist', 'skipOnError' => true, 'targetClass' => ChemStorage::className(), 'targetAttribute' => ['id_storage' => 'id_storage']],
            [['id_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['id_supplier' => 'id_supplier']],
            [['id_lokasi'], 'exist', 'skipOnError' => true, 'targetClass' => Lokasi::className(), 'targetAttribute' => ['id_lokasi' => 'id_lokasi']],
            [['jenis_bahan'], 'exist', 'skipOnError' => true, 'targetClass' => JenisBahan::className(), 'targetAttribute' => ['jenis_bahan' => 'id_jenis_bahan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bahan' => 'Id Bahan',
            'nama_bahan' => 'Nama Bahan',
            'jenis_bahan' => 'Jenis Bahan',
            'jumlah' => 'Jumlah',
            'jumlah_minimum' => 'Jumlah Minimum',
            'unit' => 'Unit',
            'tanggal_kadaluarsa' => 'Tanggal Kadaluarsa',
            'id_lokasi' => 'Id Lokasi',
            'id_supplier' => 'Id Supplier',
            'status' => 'Status',
            'id_storage' => 'Id Storage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorage()
    {
        return $this->hasOne(ChemStorage::className(), ['id_storage' => 'id_storage']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id_supplier' => 'id_supplier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasi()
    {
        return $this->hasOne(Lokasi::className(), ['id_lokasi' => 'id_lokasi']);
    }

    public function getJenisBahan()
    {
        return $this->hasOne(JenisBahan::className(), ['id_lokasi' => 'id_lokasi']);
    }
}
