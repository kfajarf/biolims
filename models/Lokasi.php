<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lokasi".
 *
 * @property integer $id
 * @property string $lokasi_penyimpanan
 * @property string $rak
 *
 * @property Reagen[] $reagens
 */
class Lokasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lokasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lokasi_penyimpanan'], 'required'],
            [['lokasi_penyimpanan'], 'string', 'max' => 100],
            [['rak'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lokasi_penyimpanan' => 'Lokasi Penyimpanan',
            'rak' => 'Rak',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReagens()
    {
        return $this->hasMany(Reagen::className(), ['id_lokasi' => 'id']);
    }
}
