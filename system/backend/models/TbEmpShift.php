<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_shift".
 *
 * @property int $id
 * @property string $description
 * @property string $clock_in
 * @property string $clock_out
 * @property string $timestamp
 */
class TbEmpShift extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_shift';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'clock_in', 'clock_out'], 'required'],
            [['clock_in', 'clock_out', 'timestamp'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Dekskripsi',
            'clock_in' => 'Jam Masuk',
            'clock_out' => 'Jam Keluar',
            'timestamp' => 'Timestamp',
        ];
    }
}
