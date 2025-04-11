<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_rec_tkp".
 *
 * @property int $id
 * @property int $id_employee
 * @property int $id_tkp_origin
 * @property int $id_tkp_destination
 * @property string $dot
 * @property string $timestamp
 */
class TbEmpRecTkp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_rec_tkp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'id_tkp_origin', 'id_tkp_destination', 'dot'], 'required'],
            [['id_employee', 'id_tkp_origin', 'id_tkp_destination'], 'integer'],
            [['dot', 'timestamp'], 'safe'],
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
            'id_tkp_origin' => 'Lokasi Kerja Sebelumnya',
            'id_tkp_destination' => 'Lokasi Kerja Sekarang',
            'dot' => 'Tanggal Pindah',
            'timestamp' => 'Timestamp',
        ];
    }
}