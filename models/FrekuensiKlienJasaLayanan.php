<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frekuensi_klien_jasa_layanan".
 *
 * @property string $kategori
 * @property string $jumlah
 */
class FrekuensiKlienJasaLayanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frekuensi_klien_jasa_layanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jumlah'], 'integer'],
            [['kategori'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kategori' => 'Kategori',
            'jumlah' => 'Jumlah',
        ];
    }
}
