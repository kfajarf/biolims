<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analysis_request".
 *
 * @property integer $id
 * @property string $lpsb_order_no
 * @property integer $id_kategori_klien
 * @property string $status_pengujian
 * @property string $tanggal_diterima
 * @property string $tanggal_selesai
 * @property integer $total_biaya
 * @property integer $dp
 * @property integer $sisa
 * @property string $keterangan
 *
 * @property KategoriKlien $idKategoriKlien
 * @property KajiUlang[] $kajiUlangs
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
            [['lpsb_order_no', 'id_kategori_klien', 'status_pengujian', 'total_biaya'], 'required'],
            [['id_kategori_klien', 'total_biaya', 'dp', 'sisa'], 'integer'],
            [['status_pengujian', 'keterangan'], 'string'],
            [['dp'], 'default', 'value' => 0],
            [['tanggal_diterima', 'tanggal_selesai', 'dp', 'sisa', 'keterangan', 'tanggal_diterima', 'tanggal_selesai'], 'safe'],
            [['lpsb_order_no'], 'string', 'max' => 100],
            [['id_kategori_klien'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriKlien::className(), 'targetAttribute' => ['id_kategori_klien' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lpsb_order_no' => 'Lpsb Order No',
            'id_kategori_klien' => 'Kategori Klien',
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
    public function getIdKategoriKlien()
    {
        return $this->hasOne(KategoriKlien::className(), ['id' => 'id_kategori_klien']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKajiUlangs()
    {
        return $this->hasMany(KajiUlang::className(), ['request_id' => 'id']);
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

    public function getKategoriAnalisis()
    {
        return $this->hasMany(KategoriAnalisis::className(), ['request_id' => 'id']);
    }
}
