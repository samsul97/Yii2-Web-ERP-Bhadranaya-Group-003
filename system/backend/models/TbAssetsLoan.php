<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_assets_loan".
 *
 * @property int $id
 * @property int $id_assets Barang Yang Di Pinjem
 * @property int $id_employee Nama Karyawan Yang Minjem
 * @property int $id_user By User
 * @property string $note
 * @property string $dol Tanggal Peminjaman
 * @property string $dor Tanggal Pengembalian
 * @property int $status
 * @property string $timestamp
 */
class TbAssetsLoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_assets_loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_assets', 'id_employee', 'id_user', 'note', 'dol', 'dor', 'status'], 'required'],
            [['id_assets', 'id_employee', 'id_user', 'status'], 'integer'],
            [['dol', 'dor', 'timestamp'], 'safe'],
            [['note'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_assets' => 'Barang',
            'id_employee' => 'Peminjam',
            'id_user' => 'Yang Minjemin',
            'note' => 'Keterangan',
            'dol' => 'Tanggal Pinjam',
            'dor' => 'Tanggal Pengembalian',
            'status' => 'Status',
            'timestamp' => 'Timestamp',
        ];
    }
}
