<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_inventory".
 *
 * @property int $id
 * @property string $sku
 * @property string $desc
 * @property string|null $induk
 * @property string $priority
 * @property string $code_satuan
 * @property string $code_in
 * @property string $code_out
 * @property string|null $code_log
 * @property string $code_waste
 * @property int $status
 */
class TbInventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'desc', 'id_in_type', 'id_in_unit', 'id_in_parent', 'code_satuan', 'code_in', 'code_out', 'code_waste'], 'required'],
            [['status', 'id_in_parent', 'id_in_type', 'id_in_unit', 'id_user'], 'integer'],
            [['sku', 'code_satuan', 'code_in', 'code_out', 'code_log', 'code_waste'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'SKU',
            'desc' => 'Desc',
            'id_in_parent' => 'Induk',
            'id_in_type' => 'Jenis',
            'id_in_unit' => 'Unit',
            'id_user' => 'Outlet',
            'code_satuan' => 'Code Satuan',
            'code_in' => 'Code In',
            'code_out' => 'Code Out',
            'code_log' => 'Code Log',
            'code_waste' => 'Code Waste',
            'status' => 'Status',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
