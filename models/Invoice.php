<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property string $no_invoice
 * @property integer $total_biaya
 * @property integer $terbilang
 * @property string $tanggal_penerbitan_invoice
 * @property integer $id_peneliti
 *
 * @property Peneliti $idPeneliti
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_invoice', 'total_biaya', 'terbilang', 'tanggal_penerbitan_invoice', 'id_peneliti'], 'required'],
            [['total_biaya', 'terbilang', 'id_peneliti'], 'integer'],
            [['tanggal_penerbitan_invoice'], 'safe'],
            [['no_invoice'], 'string', 'max' => 100],
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
            'no_invoice' => 'No Invoice',
            'total_biaya' => 'Total Biaya',
            'terbilang' => 'Terbilang',
            'tanggal_penerbitan_invoice' => 'Tanggal Penerbitan Invoice',
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
