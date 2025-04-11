<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_cctv".
 *
 * @property int $id
 * @property string $name
 * @property string $vendor
 * @property string $ip
 * @property int $port
 * @property string $username
 * @property string $password
 */
class MrCctv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_cctv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'vendor', 'ip', 'port', 'username', 'password'], 'required'],
            [['port'], 'integer', 'message' => 'port harus berupa angka'],
            [['ip'], 'ip'],
            [['name'], 'unique'],
            [['port'], 'string', 'max'=>2],
            [['name', 'vendor', 'ip', 'username', 'password'], 'string', 'max' => 50],
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
            'vendor' => 'Vendor',
            'ip' => 'Ip',
            'port' => 'Port',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
