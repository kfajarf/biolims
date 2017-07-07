<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori_klien".
 *
 * @property integer $id
 * @property string $kategori
 *
 * @property AnalysisRequest[] $analysisRequests
 */
class KategoriKlien extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_klien';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori'], 'required'],
            [['kategori'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori' => 'Kategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalysisRequests()
    {
        return $this->hasMany(AnalysisRequest::className(), ['id_kategori_klien' => 'id']);
    }
}
