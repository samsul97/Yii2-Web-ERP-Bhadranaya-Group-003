<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbinvpoparent".
 *
 * @property int $id
 * @property int $id_user
 * @property string $no_transaction
 * @property string $purchase_number_parent
 * @property string $timestamp
 */
class Tbinvpoparent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbinvpoparent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'no_transaction', 'purchase_number_parent'], 'required'],
            [['id_user'], 'integer'],
            [['timestamp'], 'safe'],
            [['no_transaction', 'purchase_number_parent'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Di Update Oleh',
            'no_transaction' => 'No Transaksi',
            'purchase_number_parent' => 'No PO Induk',
            'timestamp' => 'Tanggal',
        ];
    }

    public function detailPoAnak()
    {
        return Tbinvpochild::find()
        ->where(['id_inv_po_parent' => $this->id])
        ->all();
    }
}
