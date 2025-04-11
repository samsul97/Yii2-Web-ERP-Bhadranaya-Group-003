<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_header".
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $logo
 * @property string $logo_dark
 * @property string $favicon
 * @property string $navbar_color
 * @property string $btn_color
 * @property int $social_proof_status
 * @property int $pause_social_proof
 * @property int $time_social_proof
 * @property string $timestamp
 */
class SetFeHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_header';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'contact', 'logo', 'logo_dark', 'favicon', 'navbar_color', 'btn_color', 'social_proof_status', 'pause_social_proof', 'time_social_proof'], 'required'],
            [['social_proof_status', 'pause_social_proof', 'time_social_proof'], 'integer'],
            [['timestamp'], 'safe'],
            [['name', 'contact', 'logo', 'logo_dark', 'favicon', 'navbar_color', 'btn_color'], 'string', 'max' => 50],
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
            'contact' => 'Contact',
            'logo' => 'Logo',
            'logo_dark' => 'Logo Dark',
            'favicon' => 'Favicon',
            'navbar_color' => 'Navbar Color',
            'btn_color' => 'Button Color',
            'social_proof_status' => 'Social Proof Status',
            'pause_social_proof' => 'Pause Social Proof',
            'time_social_proof' => 'Time Social Proof',
            'timestamp' => 'Timestamp',
        ];
    }
}
