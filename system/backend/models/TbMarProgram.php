<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mar_program".
 *
 * @property int $id
 * @property int $name
 * @property string $start
 * @property string $end
 * @property string $description
 * @property string $reward
 * @property string $permalinks
 * @property string $timestamp
 */
class TbMarProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mar_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start', 'end', 'description', 'reward', 'is_reward', 'permalinks'], 'required'],
            [['permalinks'], 'url'],
            [['name'], 'unique'],
            [['start', 'end', 'timestamp'], 'safe'],
            [['description', 'reward', 'name', 'is_reward'], 'string'],
            [['permalinks'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'start' => 'Mulai',
            'end' => 'Akhir',
            'description' => 'Deksripsi/Ketentuan',
            'reward' => 'Reward',
            'is_reward' => 'Hadiah yang di dapat',
            'permalinks' => 'Link',
            'timestamp' => 'Timestamp',
        ];
    }
}
