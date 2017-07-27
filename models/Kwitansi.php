<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kwitansi".
 *
 * @property integer $id
 * @property string $no_kwitansi
 * @property string $telah_terima_dari
 * @property string $untuk_pembayaran_analisis
 * @property string $terbilang
 * @property integer $jumlah_biaya
 * @property string $tanggal_kwitansi
 * @property integer $id_peneliti
 */
class Kwitansi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kwitansi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_kwitansi', 'tanggal_kwitansi'], 'required'],
            [['id_peneliti'], 'integer'],
            [['id_peneliti'], 'safe'],
            [['no_kwitansi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_kwitansi' => 'No Kwitansi',
            'tanggal_kwitansi' => 'Tanggal Kwitansi',
            'id_peneliti' => 'Id Peneliti',
        ];
    }
}
