<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_in_unit".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $status
 */
class MrInUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_in_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['status'], 'integer'],
            [['code'], 'unique'],
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
            'code' => 'Kode Satuan',
            'name' => 'Nama Satuan',
            'status' => 'Status',
        ];
    }
}
