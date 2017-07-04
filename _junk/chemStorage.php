<?php  
	// THIS IS CHEMSTORAGE BACKUP
?>
<?php

namespace app\models;

use app\models\Reagen;
use Yii;

/**
 * This is the model class for table "chem_storage".
 *
 * @property integer $id_storage
 * @property string $status
 * @property string $id_bahan
 * @property integer $id_lokasi
 * @property string $pemilik
 * @property integer $id_supplier
 * @property string $catatan
 * @property string $tanggal_masuk
 */
class ChemStorage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chem_storage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bahan', 'id_lokasi', 'pemilik', 'id_supplier', 'tanggal_masuk'], 'required'],
            [['id_lokasi', 'id_supplier'], 'integer'],
            [['catatan'], 'string'],
            [['tanggal_masuk'], 'safe'],
            [['status', 'id_bahan'], 'string', 'max' => 30],
            [['pemilik'], 'string', 'max' => 100],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_storage' => 'Id Storage',
            'status' => 'Status',
            'id_bahan' => 'Id Bahan',
            'id_lokasi' => 'Lokasi Penyimpanan',
            'pemilik' => 'Pemilik',
            'id_supplier' => 'Supplier',
            'catatan' => 'Catatan',
            'tanggal_masuk' => 'Tanggal Masuk',
        ];
    }

    public function setStatus($jumlah, $jumlah_minimum)
    {
        return $jumlah == $jumlah_minimum ? 'Low Stock' : 'Normal' ;
    }

    public function getLokasi()
    {
        return $this ->hasOne(Lokasi::className(), ['id_lokasi' => 'id_lokasi']);
    }

    public function getReagen()
    {
        return $this ->hasOne(Reagen::className(), ['id_bahan' => 'id_bahan']);
    }

    public function getSupplier()
    {
        return $this ->hasOne(Supplier::className(), ['id_supplier' => 'id_supplier']);
    }
}
