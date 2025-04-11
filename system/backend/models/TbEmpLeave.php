<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_leave".
 *
 * @property int $id
 * @property int $id_employee
 * @property string $leave_type
 * @property string $start_date
 * @property string $till_date
 * @property string $reason
 * @property string $dof Tanggal Pengajuan
 * @property string $timestamp
 */
class TbEmpLeave extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_leave';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'leave_type', 'start_date', 'till_date', 'reason', 'dof'], 'required'],
            [['id_employee'], 'integer'],
            [['leave_type', 'leave_type_special'], 'string'],
            [['start_date', 'till_date', 'dof', 'timestamp'], 'safe'],
            [['reason'], 'string', 'max' => 255],
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
            'leave_type' => 'Jenis Cuti',
            'leave_type_special' => 'Pilihan Cuti Khusus',
            'start_date' => 'Mulai Tanggal',
            'till_date' => 'Sampai Tanggal',
            // 'years' => 'Tahun',
            'reason' => 'Alasan',
            'dof' => 'Tanggal Pengajuan Cuti',
            // 'leave_total' => 'Total Cuti',
            // 'leave_off' => 'Sisa Cuti',
            'timestamp' => 'Tanggal Buat',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
