<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mar_customer".
 *
 * @property int $id
 * @property string $name
 * @property string $telp
 * @property string $email
 * @property int $id_tkp
 * @property int $created_at
 * @property int $timestamp
 */
class TbMarCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mar_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'telp', 'email', 'id_tkp', 'created_at'], 'required'],
            [['id_tkp'], 'integer'],
            [['telp', 'email'], 'unique'],
            [['email'], 'email'],
            [['created_at', 'timestamp'], 'safe'],
            [['telp'], 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/', 'message' => 'Hanya dari nomor 0 sampai 9'],
            [['name', 'telp', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'telp' => 'Telp',
            'email' => 'Email',
            'id_tkp' => 'TKP',
            'created_at' => 'Tanggal Buat',
            'timestamp' => 'Timestamp',
        ];
    }
}
