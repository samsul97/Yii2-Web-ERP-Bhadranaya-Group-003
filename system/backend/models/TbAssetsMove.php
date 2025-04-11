<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_assets_move".
 *
 * @property int $id
 * @property int $id_tb_assets
 * @property int $id_user
 * @property int $id_tkp_asal
 * @property int $id_tkp
 * @property string $name
 * @property string $dom Date Of Move (Tanggal Pindah Barang)
 * @property string $timestamp
 */
class TbAssetsMove extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_assets_move';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tb_assets', 'id_user', 'id_tkp', 'id_tkp_origin', 'dom', 'qty_move'], 'required'],
            [['id_tb_assets', 'id_user', 'id_tkp', 'id_tkp_origin', 'qty_move'], 'integer'],
            [['dom', 'timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tb_assets' => 'Barang',
            'id_user' => 'Di Edit',
            'id_tkp_origin' => 'TKP Asal',
            'id_tkp' => 'TKP Tujuan',
            'dom' => 'Tgl Pindah',
            'qty_move' => 'Jumlah Pindah',
            'timestamp' => 'Timestamp',
        ];
    }
}
