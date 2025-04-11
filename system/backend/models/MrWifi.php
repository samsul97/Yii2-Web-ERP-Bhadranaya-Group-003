<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_wifi".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $vendor
 * @property string $ssid
 * @property string $username_modem
 * @property string $pasword_modem
 * @property string $username_login
 * @property string $password_login
 * @property string $speed
 */
class MrWifi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_wifi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url', 'vendor', 'ssid', 'username_modem', 'pasword_modem', 'username_login', 'password_login', 'speed'], 'required'],
            [['url'], 'url', 'validSchemes'=>array('https', 'http')],
            [['name'], 'unique'],
            [['name', 'url', 'vendor', 'ssid', 'username_modem', 'pasword_modem', 'username_login', 'password_login', 'speed'], 'string', 'max' => 50],
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
            'url' => 'Url',
            'vendor' => 'Vendor',
            'ssid' => 'Ssid',
            'username_modem' => 'Username Modem',
            'pasword_modem' => 'Pasword Modem',
            'username_login' => 'Username Login',
            'password_login' => 'Password Login',
            'speed' => 'Speed',
        ];
    }
}
