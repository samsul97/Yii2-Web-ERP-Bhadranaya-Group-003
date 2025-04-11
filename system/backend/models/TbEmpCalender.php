<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_calender".
 *
 * @property int $id
 * @property int $id_calender
 * @property int $id_user
 * @property int $id_tkp
 * @property string $necessity
 * @property string $vehicle
 * @property string $timestamp
 */
class TbEmpCalender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_calender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_calender', 'id_user', 'id_tkp', 'necessity'], 'required'],
            [['id_calender', 'id_user', 'id_tkp'], 'integer'],
            // [['vehicle'], 'string'],
            [['timestamp'], 'safe'],
            [['necessity'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_calender' => 'Calender',
            'id_user' => 'User',
            'id_tkp' => 'Outlet',
            'necessity' => 'Kebutuhan',
            // 'vehicle' => 'Vehicle',
            'timestamp' => 'Tanggal',
        ];
    }
}
