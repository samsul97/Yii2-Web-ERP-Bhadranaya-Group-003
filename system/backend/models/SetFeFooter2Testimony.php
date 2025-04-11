<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_footer2_testimony".
 *
 * @property int $id
 * @property string $photo
 * @property string $name
 * @property string $desc
 * @property string $timestamp
 */
class SetFeFooter2Testimony extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_footer2_testimony';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo', 'name', 'desc'], 'required'],
            [['desc'], 'string'],
            [['timestamp'], 'safe'],
            [['photo', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Foto',
            'name' => 'Name',
            'desc' => 'Testi Review',
            'timestamp' => 'Timestamp',
        ];
    }
}
