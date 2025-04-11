<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_assets_return".
 *
 * @property int $id
 * @property int $id_loan Barang Yang di Pinjam
 * @property int $id_user By User
 * @property string $condition
 * @property string $dor
 */
class TbAssetsReturn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_assets_return';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_loan', 'id_user', 'condition', 'dor'], 'required'],
            [['id_loan', 'id_user'], 'integer'],
            [['condition'], 'string'],
            [['dor'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_loan' => 'Id Loan',
            'id_user' => 'Id User',
            'condition' => 'Condition',
            'dor' => 'Dor',
        ];
    }
}
