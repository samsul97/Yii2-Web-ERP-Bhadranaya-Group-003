<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_attendance".
 *
 * @property int $id
 * @property int $id_user
 * @property string $id_shift
 * @property string $tgl
 * @property string $in_out
 * @property string $time
 * @property string $accurancy
 * @property string $location
 * @property string $description
 * @property string $image
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TbEmpAttendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_shift', 'tgl', 'in_out', 'time', 'accurancy', 'location', 'description', 'image'], 'required'],
            [['id_user'], 'integer'],
            [['tgl', 'time', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['id_shift', 'in_out', 'accurancy', 'location', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Pengguna',
            'id_shift' => 'Shift',
            'tgl' => 'Tanggal Absen',
            'in_out' => 'In/Out',
            'time' => 'Waktu',
            'accurancy' => 'Ketepatan',
            'location' => 'Lokasi',
            'description' => 'Deksripsi',
            'image' => 'Foto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
}
