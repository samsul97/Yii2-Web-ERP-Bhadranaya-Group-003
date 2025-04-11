<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbemptkpops".
 *
 * @property int $id
 * @property string $no_receipt
 * @property int $id_tkp_from
 * @property int $id_tkp_destination
 * @property int $id_user
 * @property string $pic
 * @property string $necessity
 * @property string $note
 * @property string $deadline
 * @property string $created_at
 */
class Tbemptkpops extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbemptkpops';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_receipt', 'id_tkp_from', 'id_tkp_destination', 'id_user', 'pic', 'necessity', 'note', 'deadline', 'created_at'], 'required'],
            [['id_tkp_from', 'id_tkp_destination', 'id_user'], 'integer'],
            [['necessity', 'note'], 'string'],
            [['deadline', 'created_at'], 'safe'],
            [['no_receipt', 'pic'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_receipt' => 'No Receipt',
            'id_tkp_from' => 'Id Tkp From',
            'id_tkp_destination' => 'Id Tkp Destination',
            'id_user' => 'Id User',
            'pic' => 'Pic',
            'necessity' => 'Necessity',
            'note' => 'Note',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
        ];
    }
}
