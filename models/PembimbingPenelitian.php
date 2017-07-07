<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembimbing_penelitian".
 *
 * @property integer $id
 * @property string $nama_pembimbing
 * @property integer $id_peneliti
 *
 * @property Peneliti $idPeneliti
 */
class PembimbingPenelitian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembimbing_penelitian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_pembimbing', 'id_peneliti'], 'required'],
            [['id_peneliti'], 'integer'],
            [['nama_pembimbing'], 'string', 'max' => 100],
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
            'nama_pembimbing' => 'Nama Pembimbing',
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
