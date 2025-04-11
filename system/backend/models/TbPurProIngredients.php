<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_pur_pro_ingredients".
 *
 * @property int $id
 * @property int $id_pur_pro
 * @property int $id_ingredients
 * @property int $qty
 */
class TbPurProIngredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pur_pro_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pur_pro', 'id_ingredients', 'qty'], 'required'],
            [['id_pur_pro', 'id_ingredients', 'qty'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pur_pro' => 'Id Pur Pro',
            'id_ingredients' => 'Id Ingredients',
            'qty' => 'Qty',
        ];
    }
}
