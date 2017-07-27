<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departemen".
 *
 * @property integer $id
 * @property string $nama_departemen
 * @property integer $id_fakultas
 *
 * @property Fakultas $idFakultas
 */
class Departemen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departemen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_departemen'], 'required'],
            [['id_fakultas'], 'integer'],
            [['nama_departemen', 'kode_nim'], 'string', 'max' => 100],
            [['id_fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['id_fakultas' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_departemen' => 'Nama Departemen',
            'kode_nim' => 'Kode NIM',
            'id_fakultas' => 'Id Fakultas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFakultas()
    {
        return $this->hasOne(Fakultas::className(), ['id' => 'id_fakultas']);
    }
}
