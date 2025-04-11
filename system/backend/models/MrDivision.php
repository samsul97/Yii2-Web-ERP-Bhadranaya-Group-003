<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_division".
 *
 * @property int $id
 * @property string $department_name
 * @property string $position_name
 */
class MrDivision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_division';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_name', 'position_name'], 'required'],
            [['department_name', 'position_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_name' => 'Department Name',
            'position_name' => 'Position Name',
        ];
    }
}
