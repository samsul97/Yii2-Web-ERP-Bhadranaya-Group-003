<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_footer2_section".
 *
 * @property int $id
 * @property string $group_logo
 * @property string $section_color Testimoni
 * @property string $timestamp
 */
class SetFeFooter2Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_footer2_section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_color'], 'required'],
            [['timestamp'], 'safe'],
            [['group_logo', 'section_color'], 'string', 'max' => 50],
            [['group_logo'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1 ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_logo' => 'Group Logo',
            'section_color' => 'Section Color',
            'timestamp' => 'Timestamp',
        ];
    }
}
