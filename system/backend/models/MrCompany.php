<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "mr_company".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $address
 * @property string $telp
 * @property string $email
 * @property string $vision_mision
 * @property string $products
 * @property string $domain
 * @property string $username
 * @property string $password
 * @property string $url_cpanel
 * @property int $status
 */
class MrCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'desc', 'address', 'telp', 'email', 'vision_mision', 'domain', 'username', 'password', 'url_cpanel'], 'required'],
            [['desc', 'products'], 'string'],
            [['status'], 'integer'],
            [['email'], 'email'],
            [['url_cpanel', 'domain'], 'url'],
            [['name'], 'unique'],
            [['telp'], 'match', 'pattern' => '/((\+[0-9]{6})|0)[-]?[0-9]{7}/', 'message' => 'Hanya dari nomor 0 sampai 9'],
            [['name', 'address', 'telp', 'email', 'vision_mision', 'domain', 'username', 'password', 'url_cpanel'], 'string', 'max' => 50],
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
            'desc' => 'Deskripsi',
            'address' => 'Alamat',
            'telp' => 'Telp',
            'email' => 'Email',
            'vision_mision' => 'Visi Misi',
            'products' => 'Produk',
            'domain' => 'Domain',
            'username' => 'Username Domain',
            'password' => 'Password Domain',
            'url_cpanel' => 'Url Cpanel',
            'status' => 'Status',
        ];
    }
    public function detailTKP()
    {
        return MrTkp::find()
        ->andWhere(['id_company' => $this->id])
        ->orderBy(['name' => SORT_ASC])
        ->all();
    }
    public function getManyEmployeeCompany()
    {
        return $this->hasMany(TbEmployee::class, ['id_company' => 'id']);
    }

    public static function getGrafikEmployeeCompany()
    {
        $data = [];
        foreach (static::find()->all() as $company) {
            $data[] = [StringHelper::truncate($company->name, 20), (int) $company->getManyEmployeeCompany()->count()];
        }
        return $data;
    }
}
