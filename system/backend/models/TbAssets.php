<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_assets".
 *
 * @property int $id
 * @property string $sku Kode Barang (Unique)
 * @property string $name
 * @property string $weight
 * @property string $brand
 * @property string $price
 * @property string $guarantee
 * @property string $completeness
 * @property string $dop Tanggal Beli
 * @property int $qty
 * @property string $other_information Keterangan
 * @property string $status
 * @property string $timestamp
 */
class TbAssets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_assets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tkp', 'name', 'price', 'completeness', 'id_in_category'], 'required'],
            [['id_user', 'id_tkp', 'price', 'id_in_category', 'qty', 'qty_current'], 'integer'],
            [['completeness', 'other_information'], 'string'],
            [['dop', 'guarantee', 'timestamp'], 'safe'],
            [['sku'], 'unique'],
            [['power'], 'integer', 'message' => 'Wajib di isi dengan Angka'],
            [['sku', 'name', 'brand', 'contractor', 'power', 'floor'], 'string', 'max' => 50],
            // [['condition_issue'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'No Barang',
            'id_user' => 'Divisi',
            'id_tkp' => 'OUTLET',
            'name' => 'Nama',
            'brand' => 'Brand',
            'price' => 'Harga',
            'guarantee' => 'Garansi Terakhir',
            'completeness' => 'Kelengkapan',
            'dop' => 'Tanggal Beli',
            'other_information' => 'Informasi Lain',
            // 'is_condition' => 'Kondisi',
            // 'condition_issue' => 'Issue',
            // 'status' => 'Status',
            'image' => 'Foto',
            'id_in_category' => 'Kategori',
            'contractor' => 'Kontraktor',
            'floor' => 'Lantai',
            'power' => 'Daya',
            'qty' => 'Jumlah Total',
            'qty_current' => 'Jumlah Saat ini',
            'timestamp' => 'Tanggal Buat',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
    public function detailRecordRepair() {
        return TbAssetsRepair::find()
        ->andWhere(['id_tb_assets' => $this->id])
        ->orderBy(['dor' => SORT_ASC])
        ->all();
    }
    public function detailRecordMove() {
        return TbAssetsMove::find()
        ->andWhere(['id_tb_assets' => $this->id])
        ->orderBy(['dom' => SORT_ASC])
        ->all();
    }
    public function detailRecordBroken() {
        return TbAssetsBroken::find()
        ->andWhere(['id_tb_assets' => $this->id])
        ->orderBy(['dob' => SORT_ASC])
        ->all();
    }
}
