<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemohon_analisis".
 *
 * @property integer $id
 * @property string $nama_lengkap
 * @property string $institusi_perusahaan
 * @property string $alamat
 * @property string $telp_fax
 * @property string $no_hp
 * @property string $email
 * @property string $lpsb_order_no
 *
 * @property AnalysisRequest $lpsbOrderNo
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
            [['nama_lengkap', 'institusi_perusahaan', 'alamat', 'no_hp', 'email'], 'required'],
            [['alamat'], 'string'],
            [['request_id'], 'integer'],
            [['email'], 'email'],
            [['telp_fax'], 'safe'],
            [['telp_fax'], 'default', 'value' => '-'],
            [['nama_lengkap', 'institusi_perusahaan', 'telp_fax', 'no_hp', 'email'], 'string', 'max' => 100],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnalysisRequest::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_lengkap' => 'Nama Lengkap',
            'institusi_perusahaan' => 'Institusi Perusahaan',
            'alamat' => 'Alamat',
            'telp_fax' => 'Telp Fax',
            'no_hp' => 'No Hp',
            'email' => 'Email',
            'request_id' => 'Lpsb Order No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpsbOrderNo()
    {
        return $this->hasOne(AnalysisRequest::className(), ['id' => 'request_id']);
    }
}
