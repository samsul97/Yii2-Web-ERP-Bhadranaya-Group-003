<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_in_jenis".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $priority
 */
class MrInJenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_in_jenis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['priority'], 'integer'],
            [['code', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'priority' => 'Priority',
        ];
    }
}
