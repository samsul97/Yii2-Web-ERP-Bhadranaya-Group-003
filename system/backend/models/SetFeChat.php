<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "set_fe_chat".
 *
 * @property int $id
 * @property int $chat_help_status
 * @property string $message
 * @property string $color
 * @property string $direct_wa
 * @property string $timestamp
 */
class SetFeChat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'set_fe_chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_help_status', 'message', 'color', 'direct_wa'], 'required'],
            [['chat_help_status'], 'integer'],
            [['message'], 'string'],
            [['timestamp'], 'safe'],
            [['color', 'direct_wa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_help_status' => 'Chat Help Status',
            'message' => 'Message',
            'color' => 'Color',
            'direct_wa' => 'Direct Wa',
            'timestamp' => 'Timestamp',
        ];
    }
}
