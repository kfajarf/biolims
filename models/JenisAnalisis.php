<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_analisis".
 *
 * @property integer $id
 * @property string $jenis
 *
 * @property Sampel[] $sampels
 */
class JenisAnalisis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenis_analisis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis'], 'required'],
            [['jenis'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampels()
    {
        return $this->hasMany(Sampel::className(), ['id_jenis' => 'id']);
    }
}
