<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_visit".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_tkp
 * @property string $necessity
 * @property string $vehicle
 * @property string $timestamp
 */
class TbEmpVisit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_tkp', 'necessity', 'vehicle'], 'required'],
            [['id_user', 'id_tkp'], 'integer'],
            [['vehicle'], 'string'],
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
            'id_user' => 'Pengguna',
            'id_tkp' => 'TKP',
            'necessity' => 'Keperluan',
            'vehicle' => 'Kendaraan',
            'timestamp' => 'Timestamp',
        ];
    }
}
