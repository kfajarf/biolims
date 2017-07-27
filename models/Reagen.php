<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reagen".
 *
 * @property string $id
 * @property string $nama_reagen
 * @property string $jenis_reagen
 * @property double $jumlah
 * @property double $jumlah_minimum
 * @property string $unit
 * @property string $tanggal_kadaluarsa
 * @property string $status
 * @property integer $id_lokasi
 * @property integer $id_supplier
 * @property integer $id_storage
 *
 * @property ChemStorage $idStorage
 * @property Lokasi $idLokasi
 * @property Supplier $idSupplier
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
            [['id_reagen', 'nama_reagen', 'jenis_reagen', 'jumlah', 'jumlah_minimum', 'unit', 'id_lokasi', 'id_supplier', 'suhu_penyimpanan'], 'required'],
            [['jumlah', 'jumlah_minimum'], 'number'],
            [['tanggal_kadaluarsa', 'status', 'tanggal_kadaluarsa'], 'safe'],
            [['status'], 'default', 'value' => '-'],
            [['id_lokasi', 'id_supplier', 'id_storage'], 'integer'],
            [['id_reagen', 'nama_reagen', 'status', 'suhu_penyimpanan'], 'string', 'max' => 100],
            [['unit'], 'string', 'max' => 20],
            [['id_storage'], 'exist', 'skipOnError' => true, 'targetClass' => ChemStorage::className(), 'targetAttribute' => ['id_storage' => 'id']],
            [['id_lokasi'], 'exist', 'skipOnError' => true, 'targetClass' => Lokasi::className(), 'targetAttribute' => ['id_lokasi' => 'id']],
            [['id_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['id_supplier' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_reagen' => 'Id Reagen',
            'nama_reagen' => 'Nama Reagen',
            'jenis_reagen' => 'Jenis Reagen',
            'jumlah' => 'Jumlah',
            'jumlah_minimum' => 'Jumlah Minimum',
            'unit' => 'Unit',
            'suhu_penyimpanan' => 'Suhu Penyimpanan',
            'tanggal_kadaluarsa' => 'Tanggal Kadaluarsa',
            'status' => 'Status',
            'id_lokasi' => 'Lokasi',
            'id_supplier' => 'Supplier',
            'id_storage' => 'Pemilik',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChemStorage()
    {
        return $this->hasOne(ChemStorage::className(), ['id' => 'id_storage']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasi()
    {
        return $this->hasOne(Lokasi::className(), ['id' => 'id_lokasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'id_supplier']);
    }
}
