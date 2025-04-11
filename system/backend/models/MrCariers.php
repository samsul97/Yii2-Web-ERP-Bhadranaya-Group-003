<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_cariers".
 *
 * @property int $id
 * @property string $city_name
 * @property string $position_name
 * @property string $status
 */
class MrCariers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_cariers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_name', 'position_name'], 'required'],
            [['city_name', 'status'], 'string'],
            [['position_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
            'position_name' => 'Position Name',
            'status' => 'Status',
        ];
    }
}
