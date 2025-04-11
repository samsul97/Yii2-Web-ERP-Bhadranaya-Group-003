<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tb_emp_cariers".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $telp
 * @property int $id_education
 * @property int $id_major
 * @property int $college
 * @property string $ipk
 * @property string $apprenticeship Periode Magang (Range Date)
 * @property int $id_reference
 * @property string $url
 * @property string $yof TahunMasukUniv
 * @property string $yoo TahunKeluarUniv
 * @property string $cv
 * @property string $transcripts
 * @property string $status A - Diterima, B = Tidak Diterima
 * @property string $created_at
 * @property string $timestamp
 */
class TbEmpCariers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_emp_cariers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'email', 'telp', 'id_education', 'id_major', 'college', 'ipk', 'apprenticeship', 'id_reference', 'url', 'yof', 'yoo', 'cv', 'transcripts', 'created_at'], 'required'],
            [['address', 'status'], 'string'],
            [['id_education', 'id_major', 'college', 'id_reference'], 'integer'],
            [['apprenticeship', 'yof', 'yoo', 'created_at', 'timestamp'], 'safe'],
            [['name', 'email', 'telp', 'ipk', 'url', 'cv', 'transcripts'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'email' => 'Email',
            'telp' => 'Telp',
            'id_education' => 'Id Education',
            'id_major' => 'Id Major',
            'college' => 'College',
            'ipk' => 'Ipk',
            'apprenticeship' => 'Apprenticeship',
            'id_reference' => 'Id Reference',
            'url' => 'Url',
            'yof' => 'Yof',
            'yoo' => 'Yoo',
            'cv' => 'Cv',
            'transcripts' => 'Transcripts',
            'status' => 'Status',
            'created_at' => 'Created At',
            'timestamp' => 'Timestamp',
        ];
    }
}
