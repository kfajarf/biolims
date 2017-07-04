<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kaji_ulang".
 *
 * @property integer $id
 * @property string $parameter
 * @property integer $metode
 * @property integer $peralatan
 * @property integer $personel
 * @property integer $bahan_kimia
 * @property integer $kondisi_akomodasi
 * @property string $kesimpulan
 * @property integer $request_id
 *
 * @property AnalysisRequest $request
 */
class KajiUlang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kaji_ulang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['metode', 'peralatan', 'personel', 'bahan_kimia', 'kondisi_akomodasi', 'request_id'], 'integer'],
            [['parameter', 'metode', 'peralatan', 'personel', 'bahan_kimia', 'kondisi_akomodasi'], 'required'],
            [['request_id', 'kesimpulan'], 'safe'],
            [['parameter', 'kesimpulan'], 'string', 'max' => 100],
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
            'parameter' => 'Parameter',
            'metode' => 'Metode',
            'peralatan' => 'Peralatan',
            'personel' => 'Personel',
            'bahan_kimia' => 'Bahan Kimia',
            'kondisi_akomodasi' => 'Kondisi Akomodasi',
            'kesimpulan' => 'Kesimpulan',
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
}
