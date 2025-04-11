<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_pur_products".
 *
 * @property int $id
 * @property int $id_company
 * @property string $name
 * @property string $image
 * @property int $price
 * @property string $created_at
 * @property string $timestamp
 */
class TbPurProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pur_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_company', 'name', 'image', 'price', 'created_at'], 'required'],
            [['id_company', 'price'], 'integer'],
            [['created_at', 'timestamp'], 'safe'],
            [['name', 'image'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_company' => 'Produk',
            'name' => 'Nama',
            'image' => 'Image',
            'price' => 'Harga',
            'created_at' => 'Tanggal',
            'timestamp' => 'Timestamp',
        ];
    }
}
