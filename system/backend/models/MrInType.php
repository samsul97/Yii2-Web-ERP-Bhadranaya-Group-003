<?php

namespace backend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "mr_in_type".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $priority
 * @property int $status
 */
class MrInType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mr_in_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['priority', 'status'], 'integer'],
            [['code'], 'unique'],
            [['code', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Kode Tipe',
            'name' => 'Nama',
            'priority' => 'Priority',
            'status' => 'Status',
        ];
    }
    public function getManyTypeInventory()
    {
        return $this->hasMany(TbInventory::class, ['id_in_type' => 'id']);
    }

    public static function getGrafikTypeInventory()
    {
        $data = [];
        foreach (static::find()->all() as $inventory) {
            $data[] = [StringHelper::truncate($inventory->name, 20), (int) $inventory->getManyTypeInventory()->count()];
        }
        return $data;
    }
}
