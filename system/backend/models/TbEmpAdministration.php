<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_administration".
 *
 * @property int $id
 * @property int $id_employee
 * @property int $id_letter
 * @property int $id_user Important! For value letter
 * @property string $no_letter
 * @property string|null $contents
 * @property string $no_month
 * @property string $year
 * @property string|null $pr_old_position
 * @property string|null $pr_new_position
 * @property int|null $pr_old_salary
 * @property int|null $pr_new_salary
 * @property string|null $act_old_position
 * @property string|null $act_new_position
 * @property string|null $act_date
 * @property string|null $act_date_expired
 * @property string|null $dm_old_position
 * @property string|null $dm_new_position
 * @property string|null $sm_old_position
 * @property string|null $sm_new_position
 * @property string|null $sm_old_boss
 * @property string|null $sm_new_boss
 * @property string|null $sm_old_division
 * @property string|null $sm_new_division
 * @property string|null $sm_old_company
 * @property string|null $sm_new_company
 * @property string|null $sm_old_tkp
 * @property string|null $sm_new_tkp
 * @property string $created_at
 * @property string $timestamp
 */
class TbEmpAdministration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_administration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'id_letter', 'id_user', 'no_letter', 'no_month', 'year', 'created_at'], 'required'],
            [['id_employee', 'id_letter', 'id_user', 'pr_old_salary', 'pr_new_salary'], 'integer'],
            [['no_month', 'contents'], 'string'],
            [['year', 'act_date', 'act_date_expired', 'created_at', 'timestamp'], 'safe'],
            [['no_letter', 'pr_old_position', 'pr_new_position', 'act_old_position', 'act_new_position', 'dm_old_position', 'dm_new_position', 'sm_old_position', 'sm_new_position', 'sm_old_boss', 'sm_new_boss', 'sm_old_division', 'sm_new_division', 'sm_old_company', 'sm_new_company', 'sm_old_tkp', 'sm_new_tkp'], 'string', 'max' => 50],
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
            'id_letter' => 'Jenis Surat',
            'id_user' => 'DIVISI',
            'no_letter' => 'No Surat',
            'no_month' => 'Bulan',
            'contents' => 'Isi Surat',
            'year' => 'Tahun',
            'pr_old_position' => 'Jabatan Lama',
            'pr_new_position' => 'Jabatan Baru',
            'pr_old_salary' => 'Gaji Lama',
            'pr_new_salary' => 'Gaji Baru',
            'act_old_position' => 'Jabatan Lama',
            'act_new_position' => 'Jabatan Baru',
            'act_date' => 'Tanggal Efektif',
            'act_date_expired' => 'Berlaku Hingga',
            'dm_old_position' => 'Jabatan Lama',
            'dm_new_position' => 'Jabatan Baru',
            'sm_old_position' => 'Jabatan Lama',
            'sm_new_position' => 'Jabatan Baru',
            'sm_old_boss' => 'Atasan Lama',
            'sm_new_boss' => 'Atasan Baru',
            'sm_old_division' => 'Divisi Lama',
            'sm_new_division' => 'Divisi Baru',
            'sm_old_company' => 'Perusahaan Lama',
            'sm_new_company' => 'Perusahaan Baru',
            'sm_old_tkp' => 'Lokasi Kerja Lama',
            'sm_new_tkp' => 'Lokasi Kerja Baru',
            'created_at' => 'Tanggal Dibuat',
            'timestamp' => 'Timestamp',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
    public function getTypeLetter()
    {
        return $this->hasOne(MrEmpLetter::className(), ['id' => 'id_letter']);
    }
}
