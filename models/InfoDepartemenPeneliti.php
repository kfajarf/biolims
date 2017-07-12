<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_departemen_peneliti".
 *
 * @property integer $id
 * @property string $nama_peneliti
 * @property string $nip_nrp_nim
 * @property string $nama_departemen
 * @property string $nama_fakultas
 * @property string $akronim
 */
class InfoDepartemenPeneliti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_departemen_peneliti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nama_peneliti', 'nip_nrp_nim'], 'required'],
            [['nama_peneliti', 'nip_nrp_nim', 'nama_departemen', 'nama_fakultas', 'akronim'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_peneliti' => 'Nama Peneliti',
            'nip_nrp_nim' => 'Nip Nrp Nim',
            'nama_departemen' => 'Nama Departemen',
            'nama_fakultas' => 'Nama Fakultas',
            'akronim' => 'Akronim',
        ];
    }
}
