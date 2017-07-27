<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tempat_penelitian_lain".
 *
 * @property integer $id
 * @property string $nama_tempat
 * @property integer $id_peneliti
 *
 * @property Peneliti $idPeneliti
 */
class TempatPenelitianLain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tempat_penelitian_lain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_peneliti'], 'integer'],
            [['id_peneliti','nama_tempat'], 'safe'],
            [['nama_tempat'],'default', 'value' => '-'],
            [['nama_tempat'], 'string', 'max' => 100],
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
            'nama_tempat' => 'Nama Tempat',
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
