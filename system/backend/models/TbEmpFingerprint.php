<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_fingerprint".
 *
 * @property int $id
 * @property int $id_employee
 * @property string $checkin
 * @property string $checkout
 * @property string $timestamp
 */
class TbEmpFingerprint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_fingerprint';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'checkin', 'checkout'], 'required'],
            // [['name'], 'integer'],
            // [['empnum', 'noid', 'nik', 'total_hours', 'name', 'checkin', 'checkout', 'checkin2', 'checkout2', 'checkin3', 'checkout3', 'checkin4', 'checkout4', 'checkin5', 'checkout5', 'timestamp'], 'string' => 50],
            // [['timestamp',], 'safe'],
            
            // [['empnum'], 'string' => 50],
            // [['noid'], 'string' => 50],
            // [['nik'], 'string' => 50],
            // [['total_hours'], 'string' => 50],
            // [['name'], 'string' => 50],
            // [['checkin'], 'string' => 50],
            // [['checkout'], 'string' => 50],
            // [['checkin2'], 'string' => 50],
            // [['checkout2'], 'string' => 50],
            // [['checkin3'], 'string' => 50],
            // [['checkout3'], 'string' => 50],
            // [['checkin4'], 'string' => 50],
            // [['checkout4'], 'string' => 50],
            // [['checkin5'], 'string' => 50],
            // [['checkout5'], 'string' => 50],
            // [['timestamp'], 'string' => 50],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Karyawan',
            'checkin' => 'Masuk',
            'checkout' => 'Keluar',
            'timestamp' => 'Tanggal',
            'total_hours' => 'Total Jam',
            'checkin2' => 'Scan Masuk 2',
            'checkout2' => 'Scan Pulang 2',
            'checkin3' => 'Scan Masuk 3',
            'checkout3' => 'Scan Pulang 3',
            'checkin4' => 'Scan Masuk 4',
            'checkout4' => 'Scan Pulang 4',
            'checkin5' => 'Scan Masuk 4',
            'checkout5' => 'Scan Pulang 4',
        ];
    }
}
