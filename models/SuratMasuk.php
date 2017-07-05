<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "surat_masuk".
 *
 * @property integer $id
 * @property string $nomor_surat
 * @property string $tanggal_surat
 * @property string $tanggal_terima
 * @property string $sumber_surat
 * @property string $perihal
 * @property string $keterangan
 * @property string $file_surat
 */
class SuratMasuk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surat_masuk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomor_surat', 'tanggal_surat', 'tanggal_terima', 'sumber_surat', 'perihal'], 'required'],
            [['tanggal_surat', 'tanggal_terima'], 'safe'],
            [['nomor_surat', 'sumber_surat', 'perihal', 'keterangan'], 'string', 'max' => 100],
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
            'tanggal_terima' => 'Tanggal Terima',
            'sumber_surat' => 'Sumber Surat',
            'perihal' => 'Perihal',
            'keterangan' => 'Keterangan',
            'file_surat' => 'File Surat',
        ];
    }
}
