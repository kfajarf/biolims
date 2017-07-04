<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chem_storage".
 *
 * @property integer $id_storage
 * @property string $pemilik
 * @property string $tanggal_masuk
 *
 * @property Reagen[] $reagens
 */
class ChemStorage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chem_storage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemilik'], 'required'],
            [['tanggal_masuk'], 'safe'],
            [['pemilik'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_storage' => 'Id Storage',
            'pemilik' => 'Pemilik',
            'tanggal_masuk' => 'Tanggal Masuk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReagens()
    {
        return $this->hasMany(Reagen::className(), ['id_storage' => 'id_storage']);
    }
    
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id_supplier' => 'id_supplier']);
    }

    public function getLokasi()
    {
        return $this->hasOne(Lokasi::className(), ['id_lokasi' => 'id_lokasi']);
    }

    public function getJenisBahan()
    {
        return $this->hasOne(JenisBahan::className(), ['id_lokasi' => 'id_lokasi']);
    }
}
