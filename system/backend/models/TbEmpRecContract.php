<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_rec_contract".
 *
 * @property int $id
 * @property int $id_employee
 * @property string $status_contract_origin
 * @property string $status_contract_destination
 * @property string $doc Date Of Contract
 * @property string $timestamp
 */
class TbEmpRecContract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_rec_contract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_employee', 'status_contract_origin', 'status_contract_destination', 'doc'], 'required'],
            [['id_employee'], 'integer'],
            [['status_contract_origin', 'status_contract_destination', 'doc', 'timestamp'], 'safe'],
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
            'status_contract_origin' => 'Status Contract Origin',
            'status_contract_destination' => 'Status Contract Destination',
            'doc' => 'Doc',
            'timestamp' => 'Timestamp',
        ];
    }
}
