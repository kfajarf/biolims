<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_pengguna_jasa_layanan".
 *
 * @property string $lpsb_order_no
 * @property string $kategori
 * @property string $nama_lengkap
 * @property string $institusi_perusahaan
 */
class DataPenggunaJasaLayanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_pengguna_jasa_layanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lpsb_order_no', 'kategori', 'nama_lengkap', 'institusi_perusahaan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lpsb_order_no' => 'Lpsb Order No',
            'kategori' => 'Kategori',
            'nama_lengkap' => 'Nama Lengkap',
            'institusi_perusahaan' => 'Institusi Perusahaan',
        ];
    }
}
