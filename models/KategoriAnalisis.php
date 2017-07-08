<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori_analisis".
 *
 * @property integer $id
 * @property string $analisis
 * @property integer $request_id
 *
 * @property AnalysisRequest $request
 * @property Sampel[] $sampels
 */
class KategoriAnalisis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_analisis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['analisis'], 'required'],
            [['request_id'], 'integer'],
            [['request_id','metode'], 'safe'],
            [['analisis', 'metode'], 'string', 'max' => 100],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnalysisRequest::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'analisis' => 'Analisis',
            'metode' => 'Metode',
            'request_id' => 'Request ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(AnalysisRequest::className(), ['id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampels()
    {
        return $this->hasMany(Sampel::className(), ['kategori_analisis_id' => 'id']);
    }
}
