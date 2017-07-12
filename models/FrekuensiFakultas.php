<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frekuensi_fakultas".
 *
 * @property string $nama_fakultas
 * @property string $jumlah
 */
class FrekuensiFakultas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frekuensi_fakultas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jumlah'], 'integer'],
            [['nama_fakultas'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nama_fakultas' => 'Nama Fakultas',
            'jumlah' => 'Jumlah',
        ];
    }
}
