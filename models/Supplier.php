<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $supplier
 *
 * @property Reagen[] $reagens
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier'], 'required'],
            [['supplier'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier' => 'Supplier',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReagens()
    {
        return $this->hasMany(Reagen::className(), ['id_supplier' => 'id']);
    }
}
