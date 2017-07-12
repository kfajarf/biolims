<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frekuensi_pilihan_jenis_analisis".
 *
 * @property string $analisis
 * @property string $jumlah
 */
class FrekuensiPilihanJenisAnalisis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frekuensi_pilihan_jenis_analisis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jumlah'], 'integer'],
            [['analisis'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'analisis' => 'Analisis',
            'jumlah' => 'Jumlah',
        ];
    }
}
