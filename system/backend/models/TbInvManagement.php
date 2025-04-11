<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_inv_management".
 *
 * @property int $id
 * @property int $in_arrival
 * @property int $in_selling
 * @property int $out_sales
 * @property int $out_non_sales
 * @property int|null $waste
 * @property int|null $spoiled
 * @property string $timestamp
 */
class TbInvManagement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_inv_management';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['in_arrival', 'in_selling', 'out_sales', 'out_non_sales', 'waste', 'spoiled', 'id_in_type', 'id_user', 'id_inventory', 'begin_stock', 'last_stock'], 'integer'],
            [['remarks'], 'string'],
            [['timestamp', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'in_arrival' => 'Input Datang',
            'in_selling' => 'Input Jual',
            'out_sales' => 'Out Sales',
            'out_non_sales' => 'Out Non Sales',
            'waste' => 'Waste',
            'spoiled' => 'Spoiled',
            'remarks' => 'Remarks',
            'updated_at' => 'Tanggal',
            'id_in_type' => 'Jenis',
            'id_user' => 'Cabang',
            'id_inventory' => 'Inventori',
            'timestamp' => 'Timestamp',
        ];
    }
}
