<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_leave_filter".
 *
 * @property int $id
 * @property int $id_employee
 * @property string $leave_years
 * @property int $leave_total
 * @property string $timestamp
 */
class TbEmpLeaveFilter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_leave_filter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'leave_years'], 'required'],
            [['id_employee', 'leave_total'], 'integer'],
            [['leave_years', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_employee' => 'Karyawan',
            'leave_years' => 'Tahun Cuti',
            'leave_total' => 'Total Cuti',
            'timestamp' => 'Timestamp',
        ];
    }
}
