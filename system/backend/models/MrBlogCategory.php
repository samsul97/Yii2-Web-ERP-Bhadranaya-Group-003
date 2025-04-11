<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_blog_category".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $timestamp
 */
class MrBlogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            [['timestamp'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'timestamp' => 'Timestamp',
        ];
    }
}
