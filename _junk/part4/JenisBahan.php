<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_bahan".
 *
 * @property integer $id_jenis_bahan
 * @property string $jenis_bahan
 *
 * @property Reagen[] $reagens
 */
class JenisBahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenis_bahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_bahan'], 'required'],
            [['jenis_bahan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jenis_bahan' => 'Id Jenis Bahan',
            'jenis_bahan' => 'Jenis Bahan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReagens()
    {
        return $this->hasMany(Reagen::className(), ['jenis_bahan' => 'id_jenis_bahan']);
    }
}
