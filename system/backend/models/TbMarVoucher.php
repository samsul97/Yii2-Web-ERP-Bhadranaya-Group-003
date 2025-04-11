<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mar_voucher".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $value
 * @property int $max_value
 * @property string $expired_date
 * @property int $status
 * @property string $created_at
 */
class TbMarVoucher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mar_voucher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'value', 'max_value', 'expired_date', 'status', 'id_user', 'created_at'], 'required'],
            [['value', 'max_value', 'status', 'id_user'], 'integer'],
            [['code'], 'unique'],
            [['expired_date', 'created_at'], 'safe'],
            [['code', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'TKP',
            'code' => 'Kode',
            'name' => 'Nama',
            'value' => 'Nilai',
            'max_value' => 'Nilai Maksimal',
            'expired_date' => 'Kadaluarsa',
            'status' => 'Status',
            'created_at' => 'Tanggal Dibuat',
        ];
    }
}
