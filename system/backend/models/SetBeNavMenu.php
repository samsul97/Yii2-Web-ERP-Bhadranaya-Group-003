<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_be_nav_menu".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property string $timestamp
 */
class SetBeNavMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_be_nav_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['timestamp'], 'safe'],
            [['name', 'value'], 'string', 'max' => 50],
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
            'value' => 'Value',
            'timestamp' => 'Timestamp',
        ];
    }
}
