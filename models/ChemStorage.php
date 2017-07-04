<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chem_storage".
 *
 * @property integer $id
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
            [['pemilik', 'tanggal_masuk'], 'required'],
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
            'id' => 'ID',
            'pemilik' => 'Pemilik',
            'tanggal_masuk' => 'Tanggal Masuk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReagens()
    {
        return $this->hasMany(Reagen::className(), ['id_storage' => 'id']);
    }
}
