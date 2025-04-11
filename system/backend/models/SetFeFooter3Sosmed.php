<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_footer3_sosmed".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $link
 * @property string $timestamp
 */
class SetFeFooter3Sosmed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_footer3_sosmed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon', 'link'], 'required'],
            [['timestamp'], 'safe'],
            [['name', 'icon', 'link'], 'string', 'max' => 50],
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
            'icon' => 'Icon',
            'link' => 'Link',
            'timestamp' => 'Timestamp',
        ];
    }
}
