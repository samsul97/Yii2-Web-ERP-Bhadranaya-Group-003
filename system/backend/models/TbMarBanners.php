<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mar_banners".
 *
 * @property int $id
 * @property int $id_user
 * @property string $title
 * @property string $permalinks
 * @property string $image
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property string $timestamp
 */
class TbMarBanners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mar_banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'title', 'permalinks', 'image', 'is_active', 'active_date', 'created_at', 'updated_at'], 'required'],
            [['id_user', 'is_active'], 'integer'],
            [['created_at', 'updated_at', 'active_date', 'timestamp'], 'safe'],
            [['title', 'permalinks', 'image'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Post By',
            'title' => 'Judul',
            'permalinks' => 'Link Tautan',
            'image' => 'Gambar',
            'is_active' => 'Status',
            'active_date' => 'Sampai Tgl',
            'created_at' => 'Tgl Buat',
            'updated_at' => 'Tgl Update',
            'timestamp' => 'Timestamp',
        ];
    }
}
