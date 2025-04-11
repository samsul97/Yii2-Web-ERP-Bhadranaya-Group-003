<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mar_blog".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_blog_category
 * @property string $title
 * @property string $contents
 * @property string $created_at
 * @property string $image
 * @property string $timestamp
 */
class TbMarBlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mar_blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_blog_category', 'title', 'contents', 'created_at', 'image'], 'required'],
            [['id_user', 'id_blog_category'], 'integer'],
            [['contents'], 'string'],
            [['created_at', 'timestamp'], 'safe'],
            [['title', 'image'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Dibuat',
            'id_blog_category' => 'Kategori',
            'title' => 'Judul',
            'contents' => 'Isi',
            'created_at' => 'Tanggal',
            'image' => 'Image',
            'timestamp' => 'Timestamp',
        ];
    }
}
