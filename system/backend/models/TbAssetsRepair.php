<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_assets_repair".
 *
 * @property int $id
 * @property int $id_tb_assets
 * @property int $id_user
 * @property string $is_condition
 * @property string $condition_issue
 * @property string $dor
 * @property string $timestamp
 */
class TbAssetsRepair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_assets_repair';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tb_assets', 'id_user', 'condition_issue', 'status', 'qty_repair', 'dor'], 'required'],
            [['id_tb_assets', 'id_user', 'qty_repair'], 'integer'],
            [['dor', 'timestamp'], 'safe'],
            [['condition_issue'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tb_assets' => 'Barang',
            'id_user' => 'Di Edit',
            // 'is_condition' => 'Kondisi',
            'status' => 'Status',
            'condition_issue' => 'Keterangan',
            'dor' => 'Tgl Perbaikan',
            'qty_repair' => 'Jumlah Perbaikan Barang',
            'timestamp' => 'Timestamp',
            'qty_repair' => 'Jumlah Perbaikan'
        ];
    }
}
