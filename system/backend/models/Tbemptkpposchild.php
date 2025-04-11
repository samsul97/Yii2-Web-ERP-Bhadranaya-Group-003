<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbemptkpposchild".
 *
 * @property int $id
 * @property int $id_emptkpops
 * @property string $necessity
 * @property string $image
 */
class Tbemptkpposchild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbemptkpposchild';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_emptkpops', 'necessity', 'image'], 'required'],
            [['id_emptkpops'], 'integer'],
            [['necessity'], 'string'],
            [['image'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_emptkpops' => 'Id Emptkpops',
            'necessity' => 'Necessity',
            'image' => 'Image',
        ];
    }
}
