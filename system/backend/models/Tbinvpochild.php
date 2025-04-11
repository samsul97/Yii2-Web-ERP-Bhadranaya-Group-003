<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbinvpochild".
 *
 * @property int $id
 * @property int $id_inv_po_parent
 * @property int $id_tkp
 * @property string $purchase_number_child
 * @property string $timestamp
 */
class Tbinvpochild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbinvpochild';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_inv_po_parent', 'id_tkp', 'purchase_number_child'], 'required'],
            [['id_inv_po_parent', 'id_tkp'], 'integer'],
            [['timestamp'], 'safe'],
            [['purchase_number_child'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_inv_po_parent' => 'No PO Induk',
            'id_tkp' => 'Outlet',
            'purchase_number_child' => 'PO Number Outlet',
            'timestamp' => 'Timestamp',
        ];
    }
}
