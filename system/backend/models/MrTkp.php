<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "mr_tkp".
 *
 * @property int $id
 * @property int $id_company
 * @property int $code_location
 * @property string $name
 * @property string $code
 * @property string $alamat
 * @property string $responbilities
 * @property string $no_hp
 * @property string $telp
 * @property string $ip_viewer
 * @property string $ip_pos1
 * @property string $ip_pos2
 * @property string $ip_pos3
 * @property string $ip_kitchen
 * @property string $ip_bar
 * @property string $ip_public
 * @property string $ip_office
 * @property string $ip_mikrotik
 * @property string $pass_mikrotik
 * @property string $user_mikrotik
 * @property int $id_cctv
 * @property int $id_wifi
 * @property int $status
 * @property string $created_at
 */
class MrTkp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_tkp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_company', 'code_location', 'name', 'code', 'alamat', 'responbilities', 'no_hp', 'telp', 'ip_viewer', 'ip_pos1', 'ip_pos2', 'ip_pos3', 'ip_kitchen', 'ip_bar', 'ip_public', 'ip_office', 'ip_mikrotik', 'pass_mikrotik', 'user_mikrotik', 'id_cctv', 'id_wifi', 'created_at'], 'required'],
            [['id_company', 'code_location', 'id_cctv', 'id_wifi', 'status'], 'integer'],
            [['alamat'], 'string'],
            [['created_at'], 'safe'],
            [['code_location', 'code'], 'unique'],
            [['ip_viewer', 'ip_pos1', 'ip_pos2', 'ip_pos3', 'ip_kitchen', 'ip_bar', 'ip_public', 'ip_office', 'ip_mikrotik'], 'ip'],
            [['no_hp', 'telp'], 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/', 'message' => 'Hanya dari nomor 0 sampai 9'],
            [['name', 'code', 'responbilities', 'no_hp', 'telp', 'ip_viewer', 'ip_pos1', 'ip_pos2', 'ip_pos3', 'ip_kitchen', 'ip_bar', 'ip_public', 'ip_office', 'ip_mikrotik', 'pass_mikrotik', 'user_mikrotik'], 'string', 'max' => 50],
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
            'code_location' => 'Kode Lokasi',
            'name' => 'Nama',
            'code' => 'Kode TKP',
            'alamat' => 'Alamat',
            'responbilities' => 'Penanggung Jawab TKP',
            'no_hp' => 'No Hp Penanggung Jawab',
            'telp' => 'Telp TKP',
            'ip_viewer' => 'IP Team Viewer',
            'ip_pos1' => 'IP Pos1',
            'ip_pos2' => 'IP Pos2',
            'ip_pos3' => 'IP Pos3',
            'ip_kitchen' => 'IP Printer Kitchen',
            'ip_bar' => 'IP Printer Bar',
            'ip_public' => 'IP Public',
            'ip_office' => 'IP Office',
            'ip_mikrotik' => 'IP Mikrotik',
            'pass_mikrotik' => 'Pass Mikrotik',
            'user_mikrotik' => 'User Mikrotik',
            'id_cctv' => 'CCTV',
            'id_wifi' => 'WIFI',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
    public static function getCount()
    {
        return static::find()->count();
    }
    public function detailWifi()
    {
        return MrWifi::find()
        ->andWhere(['id' => $this->id_wifi])
        ->orderBy(['vendor' => SORT_ASC])
        ->all();
    }
    public function detailCctv()
    {
        return MrCctv::find()
        ->andWhere(['id' => $this->id_cctv])
        ->orderBy(['vendor' => SORT_ASC])
        ->all();
    }
    public function getManyTkpAssets()
    {
        return $this->hasMany(TbAssets::class, ['id_tkp' => 'id']);
    }
    public static function getGrafikTkpAssets()
    {
        $data = [];
        foreach (static::find()->all() as $tkp) {
            $data[] = [StringHelper::truncate($tkp->name, 20), (int) $tkp->getManyTkpAssets()->count()];
        }
        return $data;
    }
    public function getManyTkpKaryawan()
    {
        return $this->hasMany(TbEmployee::class, ['id_tkp' => 'id']);
    }

    public static function getGrafikTkpEmployee()
    {
        $data = [];
        foreach (static::find()->all() as $tkp) {
            $data[] = [StringHelper::truncate($tkp->name, 20), (int) $tkp->getManyTkpKaryawan()->count()];
        }
        return $data;
    }
}
