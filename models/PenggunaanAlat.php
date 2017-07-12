<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penggunaan_alat".
 *
 * @property integer $id
 * @property string $nama_pengguna
 * @property string $nim
 * @property integer $kit_id
 * @property string $tanggal_penggunaan
 *
 * @property LabKit $kit
 */
class PenggunaanAlat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penggunaan_alat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_pengguna', 'nim', 'kit_id', 'tanggal_penggunaan'], 'required'],
            [['kit_id'], 'integer'],
            [['tanggal_penggunaan', 'status_pengembalian_alat'], 'safe'],
            [['status_pengembalian_alat'], 'default', 'value' => 'belum dikembalikan'],
            [['nama_pengguna'], 'string', 'max' => 100],
            [['nim'], 'string', 'max' => 30],
            [['kit_id'], 'exist', 'skipOnError' => true, 'targetClass' => LabKit::className(), 'targetAttribute' => ['kit_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_pengembalian_alat' => 'Status Pengembalian Alat',
            'nama_pengguna' => 'Nama Pengguna',
            'nim' => 'NIM',
            'kit_id' => 'Nama Alat',
            'tanggal_penggunaan' => 'Tanggal Penggunaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKit()
    {
        return $this->hasOne(LabKit::className(), ['id' => 'kit_id']);
    }
}
