<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_assets_broken".
 *
 * @property int $id
 * @property int $id_tb_assets
 * @property int $id_user
 * @property string $is_condition
 * @property string $condition_issue
 * @property string $status
 * @property string $dob Date of Broken (Tanggal Kerusakan)
 * @property string $timestamp
 */
class TbAssetsBroken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_assets_broken';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id_tb_assets', 'id_user', 'condition_issue', 'dob', 'qty_broken', 'status'], 'required'],
            [['id_tb_assets', 'id_user', 'is_sale_price', 'qty_broken'], 'integer'],
            [['is_condition', 'status', 'is_sale_where', 'is_waste_where'], 'string'],
            [['dob', 'is_sale_date', 'is_waste_date', 'timestamp'], 'safe'],
            [['condition_issue'], 'string', 'max' => 255],
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
            'qty_broken' => 'Jumlah Barang Rusak',
            'is_condition' => 'Kondisi',
            'condition_issue' => 'Keterangan',
            'status' => 'Status',
            'dob' => 'Tgl Kerusakan',
            'is_sale_price' => 'Harga Jual',
            'is_sale_where' => 'Tujuan Jual',
            'is_sale_date' => 'Tanggal Jual',
            'is_waste_where' => 'Tujuan Buang',
            'is_waste_date' => 'Tanggal Buang',
            'timestamp' => 'Timestamp',
        ];
    }
    public static function getCountSale() {
        $sale = static::find()
       ->select(['COUNT(*) AS cnt'])
       ->where(['status' => 'Dijual'])
       ->count();

       return $sale;
    }
    public static function getCountWaste() {
        $waste = static::find()
       ->select(['COUNT(*) AS cnt'])
       ->where(['status' => 'Dibuang'])
       ->count();

       return $waste;
    }
    public static function getCountBroken() {
        return static::find()->count();
    }
}
