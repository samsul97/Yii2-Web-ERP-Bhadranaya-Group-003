<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "mr_in_category".
 *
 * @property int $id
 * @property string $name
 */
class MrInCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_in_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        ];
    }
    public function getManyCategoryAssets()
    {
        return $this->hasMany(TbAssets::class, ['id_in_category' => 'id']);
    }

    public static function getGrafikCategoryAssets()
    {
        $data = [];
        foreach (static::find()->all() as $category) {
            $data[] = [StringHelper::truncate($category->name, 20), (int) $category->getManyCategoryAssets()->count()];
        }
        return $data;
    }
}
