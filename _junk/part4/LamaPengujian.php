<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lama_pengujian".
 *
 * @property integer $id_pengujian
 * @property string $status_pengujian
 * @property string $tanggal_diterima
 * @property string $tanggal_selesai
 */
class LamaPengujian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lama_pengujian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_pengujian', 'tanggal_diterima', 'tanggal_selesai'], 'required'],
            [['tanggal_diterima', 'tanggal_selesai'], 'safe'],
            [['status_pengujian'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pengujian' => 'Id Pengujian',
            'status_pengujian' => 'Status Pengujian',
            'tanggal_diterima' => 'Tanggal Diterima',
            'tanggal_selesai' => 'Tanggal Selesai',
        ];
    }
}
