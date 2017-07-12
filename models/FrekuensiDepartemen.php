<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frekuensi_departemen".
 *
 * @property string $nama_fakultas
 * @property string $nama_departemen
 * @property string $jumlah
 */
class FrekuensiDepartemen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frekuensi_departemen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jumlah'], 'integer'],
            [['nama_fakultas', 'nama_departemen'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nama_fakultas' => 'Nama Fakultas',
            'nama_departemen' => 'Nama Departemen',
            'jumlah' => 'Jumlah',
        ];
    }
}
