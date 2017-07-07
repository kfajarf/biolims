<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_sampel".
 *
 * @property string $nama_sampel
 * @property string $jenis
 * @property string $kemasan
 * @property string $jumlah
 * @property string $jenis_metode_analisis
 * @property integer $request_id
 */
class ViewSampel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_sampel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sampel_id', 'nama_sampel', 'kemasan', 'jumlah', 'jenis_metode_analisis', 'request_id'], 'required'],
            [['request_id'], 'integer'],
            [['sampel_id', 'nama_sampel', 'jenis', 'kemasan', 'jumlah', 'jenis_metode_analisis'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sampel_id' => 'Sampel ID',
            'nama_sampel' => 'Nama Sampel',
            'jenis' => 'Jenis',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'jenis_metode_analisis' => 'Jenis Metode Analisis',
            'request_id' => 'Request ID',
        ];
    }
}
