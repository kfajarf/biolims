<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis_request".
 *
 * @property string $lpsb_order_no
 * @property integer $id_pemohon
 * @property string $id_sampel
 * @property integer $id_pengujian
 * @property integer $total_biaya
 * @property integer $dp
 * @property integer $sisa
 *
 * @property PemohonAnalisis $idPemohon
 * @property Sampel $idSampel
 */
class AnalysisRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analysis_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lpsb_order_no', 'id_pemohon', 'id_sampel', 'id_pengujian', 'total_biaya', 'dp', 'sisa'], 'required'],
            [['total_biaya', 'dp', 'sisa'], 'integer'],
            [['lpsb_order_no'], 'string', 'max' => 255],
            [['id_sampel'], 'string', 'max' => 100],
            [['tanggal_diterima'], 'safe'],
            [['id_pemohon'], 'exist', 'skipOnError' => true, 'targetClass' => PemohonAnalisis::className(), 'targetAttribute' => ['id_pemohon' => 'id_pemohon']],
            [['id_sampel'], 'exist', 'skipOnError' => true, 'targetClass' => Sampel::className(), 'targetAttribute' => ['id_sampel' => 'id_sampel']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lpsb_order_no' => 'Lpsb Order No',
            'id_pemohon' => 'Id Pemohon',
            'id_sampel' => 'Id Sampel',
            'id_pengujian' => 'Id Pengujian',
            'total_biaya' => 'Total Biaya',
            'dp' => 'Dp',
            'sisa' => 'Sisa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemohon()
    {
        return $this->hasOne(PemohonAnalisis::className(), ['id_pemohon' => 'id_pemohon']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampel()
    {
        return $this->hasMany(Sampel::className(), ['id_sampel' => 'id_sampel']);
    }

    public function getPengujian()
    {
        return $this->hasOne(LamaPengujian::className(), ['id_pengujian' => 'id_pengujian']);
    }
}
