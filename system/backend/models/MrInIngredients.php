<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_in_ingredients".
 *
 * @property int $id
 * @property int $id_supplier
 * @property int $id_in_unit
 * @property string $name
 * @property string $timestamp
 */
class MrInIngredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_in_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_supplier', 'id_in_unit', 'name'], 'required'],
            [['id_supplier', 'id_in_unit'], 'integer'],
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
            'id_supplier' => 'Supplier',
            'id_in_unit' => 'Unit',
            'name' => 'Name',
            'timestamp' => 'Timestamp',
        ];
    }
}
