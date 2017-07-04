<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemohon_analisis".
 *
 * @property integer $id_pemohon
 * @property string $nama
 * @property string $institusi
 * @property string $alamat
 * @property string $telp_fax
 * @property string $no_hp
 * @property string $email
 *
 * @property AnalysisRequest[] $analysisRequests
 */
class PemohonAnalisis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pemohon_analisis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'institusi', 'alamat', 'telp_fax', 'no_hp', 'email'], 'required'],
            [['alamat'], 'string'],
            [['nama', 'institusi'], 'string', 'max' => 255],
            [['telp_fax', 'no_hp'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pemohon' => 'Id Pemohon',
            'nama' => 'Nama',
            'institusi' => 'Institusi',
            'alamat' => 'Alamat',
            'telp_fax' => 'Telp Fax',
            'no_hp' => 'No Hp',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalysisRequests()
    {
        return $this->hasMany(AnalysisRequest::className(), ['id_pemohon' => 'id_pemohon']);
    }
}
