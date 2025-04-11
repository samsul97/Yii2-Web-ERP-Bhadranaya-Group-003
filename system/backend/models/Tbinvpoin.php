<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbinvpoin".
 *
 * @property int $id
 * @property int $id_inv_po_child
 * @property int $id_in_unit
 * @property string $name
 * @property string $qty
 * @property string $doe Tanggal Masuk
 * @property string $timestamp
 */
class Tbinvpoin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbinvpoin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_inv_po_child', 'id_in_unit', 'id_pur_supplier', 'id_inv'], 'integer'],
            [['id_in_unit', 'qty', 'id_pur_supplier', 'id_inv', 'qty', 'doe'], 'required'],
            [['doe', 'timestamp'], 'safe'],
            [['qty'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_inv_po_child' => 'Po Child',
            'id_in_unit' => 'Unit',
            'id_inv' => 'Item',
            'qty' => 'Qty',
            'doe' => 'Doe',
            'id_pur_supplier' => 'Supplier',
            'timestamp' => 'Timestamp',
        ];
    }
}
