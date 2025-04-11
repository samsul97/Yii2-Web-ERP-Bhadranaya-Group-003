<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_emp_letter".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $desc
 * @property string $timestamp
 */
class MrEmpLetter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_emp_letter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'desc'], 'required'],
            [['desc'], 'string'],
            [['code'], 'unique'],
            [['timestamp'], 'safe'],
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
            'code' => 'Kode',
            'name' => 'Nama',
            'desc' => 'Deskripsi',
            'timestamp' => 'Timestamp',
        ];
    }
}
