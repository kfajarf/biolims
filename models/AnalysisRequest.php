<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis_request".
 *
 * @property string $id
 * @property string $status_pengujian
 * @property string $tanggal_diterima
 * @property string $tanggal_selesai
 * @property integer $total_biaya
 * @property integer $dp
 * @property integer $sisa
 * @property string $keterangan
 *
 * @property PemohonAnalisis[] $pemohonAnalises
 * @property Sampel[] $sampels
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
            [['lpsb_order_no', 'status_pengujian', 'tanggal_diterima', 'tanggal_selesai'], 'required'],
            [['lpsb_order_no'], 'unique'],
            [['status_pengujian', 'keterangan'], 'string'],
            [['total_biaya', 'dp'], 'default', 'value' => 0],
            [['sisa', 'total_biaya', 'dp', 'keterangan'], 'safe'],
            [['id', 'total_biaya', 'dp', 'sisa'], 'integer'],
            [['lpsb_order_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lpsb_order_no' => 'LPSB Order No',
            'status_pengujian' => 'Status Pengujian',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
            'total_biaya' => 'Total Biaya',
            'dp' => 'Dp',
            'sisa' => 'Sisa',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemohonAnalisis()
    {
        return $this->hasOne(PemohonAnalisis::className(), ['request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampels()
    {
        return $this->hasMany(Sampel::className(), ['request_id' => 'id']);
    }

    public function getKajiUlang()
    {
        return $this->hasMany(KajiUlang::className(), ['request_id' => 'id']);
    }
}
