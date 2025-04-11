<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_be_view".
 *
 * @property int $id
 * @property string $header_side_logo
 * @property string $header_side_color
 * @property string $navbar_main_color
 * @property string $navbar_btn_color
 * @property string $sidebar_color
 * @property string $footer_color
 * @property string $footer_content
 * @property string $favicon
 * @property string $timestamp
 */
class SetBeView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_be_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header_side_logo', 'header_side_color', 'navbar_main_color', 'navbar_btn_color', 'sidebar_color', 'footer_color', 'footer_content', 'favicon'], 'required'],
            [['timestamp'], 'safe'],
            [['header_side_logo', 'header_side_color', 'navbar_main_color', 'navbar_btn_color', 'sidebar_color', 'footer_color', 'footer_content', 'favicon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header_side_logo' => 'Header Side Logo',
            'header_side_color' => 'Header Side Color',
            'navbar_main_color' => 'Navbar Main Color',
            'navbar_btn_color' => 'Navbar Btn Color',
            'sidebar_color' => 'Sidebar Color',
            'footer_color' => 'Footer Color',
            'footer_content' => 'Footer Content',
            'favicon' => 'Favicon',
            'timestamp' => 'Timestamp',
        ];
    }
}
