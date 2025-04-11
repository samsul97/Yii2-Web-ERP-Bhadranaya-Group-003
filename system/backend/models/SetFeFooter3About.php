<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_footer3_about".
 *
 * @property int $id
 * @property string $desc
 * @property string $timestamp
 */
class SetFeFooter3About extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_footer3_about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['desc'], 'string'],
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
            'desc' => 'Desc',
            'timestamp' => 'Timestamp',
        ];
    }
}
