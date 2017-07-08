<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sampel".
 *
 * @property integer $id
 * @property string $sampel_id
 * @property string $nama_sampel
 * @property string $kemasan
 * @property string $jumlah
 * @property string $jenis_metode_analisis
 * @property integer $kategori_analisis_id
 *
 * @property KategoriAnalisis $kategoriAnalisis
 */
class Sampel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sampel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sampel_id', 'nama_sampel', 'kemasan'], 'required'],
            [['kategori_analisis_id', 'jumlah'], 'integer'],
            [['kategori_analisis_id', 'jumlah'], 'safe'],
            [['jumlah'], 'default', 'value' => 1],
            [['sampel_id', 'nama_sampel', 'kemasan'], 'string', 'max' => 100],
            [['kategori_analisis_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriAnalisis::className(), 'targetAttribute' => ['kategori_analisis_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sampel_id' => 'Sampel ID',
            'nama_sampel' => 'Nama Sampel',
            'kemasan' => 'Kemasan',
            'jumlah' => 'Jumlah',
            'kategori_analisis_id' => 'Kategori Analisis ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriAnalisis()
    {
        return $this->hasOne(KategoriAnalisis::className(), ['id' => 'kategori_analisis_id']);
    }
}
