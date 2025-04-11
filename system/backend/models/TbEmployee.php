<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_employee".
 *
 * @property int $id
 * @property string $nie Nomer Induk Karyawan
 * @property string $nie_old Nomer Induk Karyawan Lama
 * @property string $nik Nomer Induk Kependudukan
 * @property string $name
 * @property int $id_tkp
 * @property string $status
 * @property string|null $date_join
 * @property string|null $date_resign
 * @property string|null $department
 * @property string $position
 * @property string $pob
 * @property string|null $dob
 * @property string $gender
 * @property string $married_status
 * @property string $national
 * @property string $education
 * @property string $address
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $sub_district
 * @property string $postcode
 * @property string $handphone
 * @property string $email
 * @property string|null $image
 */
class TbEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tkp', 'id_company', 'nie', 'nik', 'name', 'date_join', 'department', 'position', 'pob', 'dob', 'married_status', 'national', 'education', 'address', 'province', 'city', 'district', 'handphone', 'email', 'religion', 'sor', 'id_bank'], 'required'],
            [['id_tkp', 'id_company', 'salary', 'id_bank'], 'integer'],
            [['account_number'], 'integer', 'message' => 'Wajib di isi dengan angka'],
            [['status', 'gender', 'religion', 'married_status', 'national', 'other_information', 'sor'], 'string'],
            [['address'], 'string', 'max' => 250],
            [['postcode'], 'string', 'max' => 5],
            [['nie'], 'unique'],
            [['email'], 'email'],
            // [['facilities'], 'string'],
            // [['facilities'], 'integer'],
            [['nik'], 'string', 'length' => 16],
            [['npwp'], 'string', 'length' => 15],
            [['handphone', 'telp'], 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/', 'message' => 'Hanya dari nomor 0 sampai 9'],
            [['date_join', 'date_resign', 'dob', 'facilities', 'status_contract', 'status_probation'], 'safe'],
            [['nie', 'nie_old', 'nik', 'npwp', 'name', 'department', 'position', 'pob', 'education', 'province', 'city', 'district', 'handphone', 'email', 'image', 'account_number', 'fac_tk_nominal', 'fac_tj_nominal', 'fac_tbk_nominal', 'telp', 'status_resign_reason'], 'string', 'max' => 50],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_company' => 'Perusahaan',
            'nie' => 'NIP',
            'nie_old' => 'NIP OLD',
            'nik' => 'NIK',
            'npwp' => 'NPWP',
            'salary' => 'Gaji Pokok',
            'name' => 'Nama',
            'id_tkp' => 'Lokasi Kerja',
            'status' => 'Status',
            'date_join' => 'Masuk',
            'date_resign' => 'Keluar',
            'department' => 'Divisi',
            'position' => 'Jabatan',
            'pob' => 'Tempat Lahir',
            'dob' => 'Tanggal Lahir',
            'gender' => 'Jenis Kelamin',
            'married_status' => 'Status Kawin',
            'national' => 'Kewarganegaraan',
            'education' => 'Pendidikan',
            'address' => 'Tempat Tinggal Saat Ini',
            'province' => 'Provinsi',
            'city' => 'Kota',
            'district' => 'Kecamatan',
            'postcode' => 'Kode Pos',
            'handphone' => 'Handphone',
            'email' => 'Email',
            'image' => 'Foto KTP',
            'facilities' => 'Fasilitas',
            'fac_tk_nominal' => 'Nominal Tunjangan Komunikasi',
            'fac_tj_nominal' => 'Nominal Tunjangan Jabatan',
            'fac_tbk_nominal' => 'Nominal BPJS Kesehatan',
            'account_number' => 'Nomor Rekening',
            'other_information' => 'Informasi Tambahan',
            'religion' => 'Agama',
            'telp' => 'Telp Rumah',
            'sor' => 'Status Tempat Tinggal',
            'status_contract' => 'Lama Kontrak',
            'status_probation' => 'Lama Percobaan',
            'status_resign_reason' => 'Alasan Berhenti',
            'id_bank' => 'BANK',
            // 'leave_off' => 'Sisa Cuti',
        ];
    }
    // count employee all
    public static function getCount()
    {
        return static::find()->count();
    }
    // count employee active
    public static function getCountActive()
    {
       $permanent = static::find()
       ->select(['COUNT(*) AS cnt'])
       ->where(['status' => 'permanent'])
       ->count();
       
       $probation = static::find()
        ->select(['COUNT(*) AS cnt'])
        ->where(['status' => 'probation'])
        ->count();

        $contract = static::find()
        ->select(['COUNT(*) AS cnt'])
        ->where(['status' => 'contract'])
        ->count();

        $jumlah = $permanent + $probation + $contract;

        return $jumlah;
    }
    // count employee non active
    public static function getCountNonActive()
    {
        $resign = static::find()
       ->select(['COUNT(*) AS cnt'])
       ->where(['status' => 'resign'])
       ->count();
       
       $blacklist = static::find()
        ->select(['COUNT(*) AS cnt'])
        ->where(['status' => 'blacklist'])
        ->count();

        $jumlah = $resign + $blacklist;

        return $jumlah;
    }
    // count grafik employee status
    public static function getManyStatusKaryawan()
    {
        $rows= Yii::$app->db->createCommand('
        SELECT 
        status AS `0`, 
        COUNT(*) AS `1`
        FROM tb_employee
        GROUP BY status
        ')->queryAll();

        // $stat = static::find()
        // ->select(['status AS `0`', 'COUNT(*) AS `1`'])
        // ->groupBy(['status'])
        // ->all();

        // echo '<pre>';
        // print_r($rows);
        // die;

        return $rows;
    }
    // count grafik employee education
    public static function getManyEducationKaryawan()
    {
        
    }
    // Daftar Cuti Karyawan
    public function detailLeave()
    {
        return TbEmpLeave::find()
        ->andWhere(['id_employee' => $this->id])
        ->orderBy(['reason' => SORT_ASC])
        ->all();
    }
    // Daftar Surat Karyawan
    public function detailCorrespondence()
    {
        return TbEmpAdministration::find()
        ->andWhere(['id_employee' => $this->id])
        ->orderBy(['no_letter' => SORT_DESC])
        ->all();
    }
    // Cuti Berlangsung
    public function detailLeaveLive()
    {
        return TbEmpLeave::find()
        ->where(['between', 'date', $this->start_date, $this->till_date])
        ->orderBy(['reason' => SORT_ASC])
        ->all();
    }
    // Record Lokasi Kerja Karyawan
    public function detailRecordTkp()
    {
        return TbEmpRecTkp::find()
        ->where(['id_employee' => $this->id])
        ->orderBy(['dot' => SORT_ASC])
        ->all();
    }
    // Record Kontrak Kerja Karyawan
    public function detailRecordContract()
    {
        return TbEmpRecContract::find()
        ->where(['id_employee' => $this->id])
        ->orderBy([
            'doc' => SORT_ASC,
            'status_contract_origin' => SORT_ASC,
        ])
        ->all();
    }
}
