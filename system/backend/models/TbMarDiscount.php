<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mar_discount".
 *
 * @property int $id
 * @property int $id_products
 * @property string $start_date
 * @property string $end_date
 * @property float $percent
 * @property int $price_discount
 * @property string $timestamp
 */
class TbMarDiscount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mar_discount';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_products', 'start_date', 'end_date', 'percent', 'price_discount'], 'required'],
            [['id_products', 'price_discount'], 'integer'],
            [['start_date', 'end_date', 'timestamp'], 'safe'],
            [['percent'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_products' => 'Produk',
            'start_date' => 'Mulai',
            'end_date' => 'Selesai',
            'percent' => 'Persen',
            'price_discount' => 'Harga',
            'timestamp' => 'Timestamp',
        ];
    }
}
