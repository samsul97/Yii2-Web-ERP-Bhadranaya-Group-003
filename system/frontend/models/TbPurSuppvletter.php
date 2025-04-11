<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tb_pur_suppvletter".
 *
 * @property int $id
 * @property string $no_vendor
 * @property string $offering_letter
 * @property string $created_at
 */
class TbPurSuppvletter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pur_suppvletter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_vendor'], 'required'],
            [['created_at'], 'safe'],
            [['no_vendor'], 'string', 'max' => 50],
            [['offering_letter'], 'file', 'extensions'=>'docx, doc, pdf, xls'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_vendor' => 'No Vendor',
            'offering_letter' => 'Surat Penawaran',
            'created_at' => 'Tanggal Upload',
        ];
    }
}
