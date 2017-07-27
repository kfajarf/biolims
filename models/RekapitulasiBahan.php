<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rekapitulasi_bahan".
 *
 * @property integer $id
 * @property string $nama_bahan
 * @property string $spesifikasi
 * @property integer $jumlah
 * @property integer $harga
 * @property string $keterangan
 * @property integer $id_peneliti
 *
 * @property Peneliti $idPeneliti
 */
class RekapitulasiBahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekapitulasi_bahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_bahan'], 'required'],
            [['jumlah', 'harga', 'id_peneliti'], 'integer'],
            [['spesifikasi', 'jumlah', 'harga', 'keterangan', 'id_peneliti'], 'safe'],
            [['jumlah', 'harga'], 'default', 'value' => 0],
            [['nama_bahan', 'spesifikasi', 'keterangan'], 'string', 'max' => 100],
            [['id_peneliti'], 'exist', 'skipOnError' => true, 'targetClass' => Peneliti::className(), 'targetAttribute' => ['id_peneliti' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_bahan' => 'Nama Bahan',
            'spesifikasi' => 'Unit',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
            'keterangan' => 'Keterangan',
            'id_peneliti' => 'Id Peneliti',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPeneliti()
    {
        return $this->hasOne(Peneliti::className(), ['id' => 'id_peneliti']);
    }
}
