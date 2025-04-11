<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_loan".
 *
 * @property int $id
 * @property int $id_user
 * @property int $nominal
 * @property string $description
 * @property string $dof Tanggal Pengajuan
 * @property string $timestamp
 */
class TbEmpLoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'nominal', 'description', 'dof'], 'required'],
            [['id_employee', 'nominal'], 'integer'],
            [['dof', 'timestamp'], 'safe'],
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
            'id_employee' => 'Karyawan',
            'nominal' => 'Nominal',
            'description' => 'Deskripsi',
            'dof' => 'Tanggal Pengajuan',
            'timestamp' => 'Timestamp',
        ];
    }
}
