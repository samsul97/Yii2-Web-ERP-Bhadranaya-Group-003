<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mr_email".
 *
 * @property int $id
 * @property int $id_company
 * @property string $email
 * @property string $pass
 */
class MrEmail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_company', 'email', 'pass'], 'required'],
            [['id_company'], 'integer'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['email', 'pass'], 'string', 'max' => 50],
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
            'email' => 'Email',
            'pass' => 'Password',
        ];
    }
}
