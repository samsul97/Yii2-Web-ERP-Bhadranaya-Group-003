<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_footer3_help".
 *
 * @property int $id
 * @property int $id_menu
 * @property string $timestamp
 */
class SetFeFooter3Help extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_footer3_help';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_menu'], 'required'],
            [['id_menu'], 'integer'],
            [['timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_menu' => 'Menu',
            'timestamp' => 'Timestamp',
        ];
    }
}
