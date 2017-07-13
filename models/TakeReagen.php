<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "take_reagen".
 *
 * @property string $id_reagen
 * @property string $nama_reagen
 * @property integer $jumlah
 *
 * @property Reagen $idReagen
 */
class TakeReagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'take_reagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_reagen', 'nama_reagen', 'jumlah', 'tanggal_pengambilan'], 'required'],
            [['jumlah'], 'integer'],
            [['tanggal_pengambilan','chem_storage_id', 'unit'], 'safe'],
            [['id_reagen', 'nama_reagen'], 'string', 'max' => 100],
            [['id_reagen'], 'exist', 'skipOnError' => true, 'targetClass' => Reagen::className(), 'targetAttribute' => ['id_reagen' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_reagen' => 'Id Reagen',
            'nama_reagen' => 'Nama Reagen',
            'jumlah' => 'Jumlah',
            'unit' => 'Unit',
            'tanggal_pengambilan' => 'Tanggal Pengambilan',
            'chem_storage_id' => 'Chem ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdReagen()
    {
        return $this->hasOne(Reagen::className(), ['id' => 'id_reagen']);
    }
}
