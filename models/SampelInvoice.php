<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sampel_penelitian".
 *
 * @property integer $id
 * @property string $sampel
 * @property string $kode
 * @property string $analisis
 * @property integer $jumlah
 * @property integer $harga
 * @property integer $id_peneliti
 *
 * @property Peneliti $idPeneliti
 */
class SampelInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sampel_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sampel', 'kode'], 'required'],
            [['jumlah', 'harga', 'id_peneliti'], 'integer'],
            [['id_peneliti', 'analisis', 'jumlah', 'harga'], 'safe'],
            [['sampel', 'kode', 'analisis'], 'string', 'max' => 100],
            [['id_peneliti'], 'exist', 'skipOnError' => true, 'targetClass' => Peneliti::className(), 'targetAttribute' => ['id_peneliti' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sampel' => 'Sampel',
            'kode' => 'Kode',
            'analisis' => 'Analisis',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
            'id_peneliti' => 'Id Peneliti',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPeneliti()
    {
        return $this->hasOne(Peneliti::className(), ['id' => 'id_peneliti']);
    }
}
