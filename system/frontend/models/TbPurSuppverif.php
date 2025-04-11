<?php

namespace frontend\models;

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
            [['type_business', 'name', 'residence_address', 'letter_address', 'telp', 'email', 'id_tb_bf', 'id_bank', 'account_number', 'swift_code', 'payment_method', 'branch_bank', 'telp_dr', 'email_dr', 'name_sl', 'no_sl', 'email_sl', 'id_user', 'created_at'], 'required'],
            [['type_business', 'residence_address', 'letter_address', 'payment_method'], 'string'],
            [['id_tb_bf', 'id_bank', 'id_user'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'telp', 'telp_dr', 'facsimile', 'email', 'email_dr', 'account_number', 'branch_bank', 'name_sl', 'no_sl', 'email_sl', 'swift_code', 'tb_bf_etc'], 'string', 'max' => 50],
            [['no_vendor'], 'string', 'max' => 11],
            [['email', 'email_dr', 'email_sl'], 'email'],
            [['no_vendor'], 'unique'],
            [['account_number'], 'integer', 'message' => 'Wajib di isi dengan angka'],
            [['telp', 'telp_dr', 'no_sl'], 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/', 'message' => 'Hanya dari nomor 0 sampai 9'],
            [['img_nib'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
            [['img_npwp'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
            [['img_directur'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
            // [['sk_menkeh'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
            [['offering_letter'], 'file', 'extensions'=>'docx, doc, pdf, xls'],
            [['sk_menkeh'], 'file', 'skipOnEmpty' => true, 'extensions'=>'docx, doc, pdf, xls'],
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
            'name' => 'Nama Perusahaan',
            'residence_address' => 'Alamat Domisili Perusahaan',
            'letter_address' => 'Alamat Surat Menyurat',
            'telp' => 'Handphone',
            'facsimile' => 'Faksimil',
            'email' => 'Email',
            'id_tb_bf' => 'Bidang Usaha',
            'id_bank' => 'Bank',
            'account_number' => 'Nomor Rekening',
            'branch_bank' => 'Bank Cabang',
            'swift_code' => 'Swift Code',
            'payment_method' => 'Cara Pembayaran',
            'offering_letter' => 'Surat Penawaran',
            'email_dr' => 'Email Direktur',
            'telp_dr' => 'Handphone Direktur',
            'img_directur' => 'Upload KTP Direktur Utama',
            'name_sl' => 'Nama Sales',
            'no_sl' => 'Handphone Sales',
            'email_sl' => 'Email Sales',
            'tb_bf_etc' => 'Bidang Usaha Lain-lain',
            'top' => 'Terms Of Payment',
            'id_user' => 'Divisi',
            'created_at' => 'Tanggal Registrasi',
        ];
    }
}
