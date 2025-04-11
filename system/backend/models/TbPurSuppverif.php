<?php

namespace backend\models;

use frontend\models\TbPurSuppvletter;
use Yii;

/**
 * This is the model class for table "tb_pur_suppverif".
 *
 * @property int $id
 * @property string $type_business
 * @property string $img_nib
 * @property string $img_npwp
 * @property string $img_directur
 * @property string $name
 * @property string $residence_address
 * @property string $letter_address
 * @property string $telp
 * @property string $facsimile
 * @property string $email
 * @property int $id_tb_bf
 * @property int $id_bank
 * @property string $account_number
 * @property string $swift_code
 * @property string $payment_method
 * @property string $offering_letter
 * @property string $created_at
 */
class TbPurSuppverif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pur_suppverif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_business', 'img_nib', 'img_npwp', 'img_directur', 'name', 'residence_address', 'letter_address', 'telp', 'facsimile', 'email', 'id_tb_bf', 'id_bank', 'account_number', 'swift_code', 'payment_method', 'offering_letter', 'created_at'], 'required'],
            [['type_business', 'residence_address', 'letter_address', 'payment_method'], 'string'],
            [['id_tb_bf', 'id_bank'], 'integer'],
            [['created_at'], 'safe'],
            [['img_nib', 'img_npwp', 'img_directur', 'name', 'telp', 'facsimile', 'email', 'account_number', 'swift_code', 'offering_letter'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_business' => 'Tipe Bisnis',
            'img_nib' => 'Foto NIB',
            'img_npwp' => 'Foto NPWP',
            'img_directur' => 'Upload KTP Direktur Utama',
            'name' => 'Nama Perusahaan',
            'residence_address' => 'Alamat Domisili',
            'letter_address' => 'Alamat Surat',
            'telp' => 'Nomor Telp',
            'facsimile' => 'Faksimil',
            'email' => 'Email',
            'id_tb_bf' => 'Bidang Usaha',
            'id_bank' => 'Bank',
            'account_number' => 'Nomor Rekening',
            'swift_code' => 'Swift Code',
            'payment_method' => 'Cara Pembayaran',
            'offering_letter' => 'Surat Penawaran',
            'tb_bf_etc' => 'Bidang Usaha Lain-lain',
            'created_at' => 'Tanggal Registrasi',
        ];
    }
    public function detailLetter()
    {
        return TbPurSuppvletter::find()
        ->andWhere(['no_vendor' => $this->no_vendor])
        ->orderBy(['created_at' => SORT_ASC])
        ->all();
    }
}
