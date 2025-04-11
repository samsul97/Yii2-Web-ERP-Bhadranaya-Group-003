<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_payroll".
 *
 * @property int $id
 * @property int $id_employee Get Cuti dan Absen Karyawan
 * @property string $month_years
 * @property int $salary
 * @property string $created_at
 */
class TbEmpPayroll extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_payroll';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'month_years', 'salary', 'created_at'], 'required'],
            [['id_employee', 'salary'], 'integer'],
            [['month_years', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_employee' => 'Id Employee',
            'month_years' => 'Month Years',
            'salary' => 'Salary',
            'created_at' => 'Created At',
        ];
    }
}
