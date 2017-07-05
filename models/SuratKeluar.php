<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "surat_keluar".
 *
 * @property integer $id
 * @property string $nomor_surat
 * @property string $tanggal_surat
 * @property string $pembuat
 * @property string $tujuan_surat
 * @property string $perihal
 * @property string $keterangan
 * @property string $file_surat
 */
class SuratKeluar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surat_keluar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomor_surat', 'tanggal_surat', 'pembuat', 'tujuan_surat', 'perihal', 'file_surat'], 'required'],
            [['tanggal_surat'], 'safe'],
            [['nomor_surat', 'pembuat', 'tujuan_surat', 'perihal', 'keterangan'], 'string', 'max' => 100],
            [['file_surat'], 'file', 'extensions' => 'pdf, docx, doc, jpeg, jpg, png, zip, rar', 'maxSize' => \Yii::$app->params['maxFileSize']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_surat' => 'Nomor Surat',
            'tanggal_surat' => 'Tanggal Surat',
            'pembuat' => 'Pembuat',
            'tujuan_surat' => 'Tujuan Surat',
            'perihal' => 'Perihal',
            'keterangan' => 'Keterangan',
            'file_surat' => 'File Surat',
        ];
    }
}
