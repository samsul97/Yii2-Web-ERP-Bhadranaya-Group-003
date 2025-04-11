<?php 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helper;
use backend\models\TbAssets;
?>
<div class="table-responsive table-nowrap">
    <table class="table table-striped table-bordered">
        <thead>
            <tr">
                <th style="text-align: center; border-right: none;">Jml Total</th>
                <th style="text-align: center; border-left: none; border-right: none"></th>
                <th style="text-align: center; border-left: none; border-right: none">Jml Rusak</th>
                <!-- <th style="text-align: center; border-left: none"></th> -->
                <th style="text-align: center;">Jml Saat Ini</th>
                <th style="text-align: center;">Jml Perbaikan</th>
                <th style="text-align: center;">Jml Pindah</th>
                <!-- <th style="text-align: center;">Posisi Terakhir</th>
                <th style="text-align: center;">Kondisi Terakhir</th> -->
                <!-- <th style="text-align: center;">Status</th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center; border-right: none">
                    <?= '<b>' .$model['qty'].'</b>' ?>
                </td>
                <td style="text-align: center; border-left: none; border-right: none">
                    <b>-</b>
                </td>
                <!-- qty_current itu jumlah yang sudah di kalkulasi/dinamis qtynya berdasarkan perhitungan dari (qty_current-qty_broken) -->
                <!-- jumlah rusak didapat dari perhitungan qty_current - qty_broken -->
                <td style="text-align: center; border-left: none; border-right: none">
                    <?= Html::a($model_broken ? '<b>'.$model_broken.'</b>' : '<b>0</b>', ['tb-assets/detail-record-broken', 'id_tb_assets' => $model['id']]); ?>
                </td>
                <!-- <td style="text-align: center; border-left: none">
                    <b>=</b>
                </td> -->
                <td style="text-align: center;">
                    <?= '<b>'.$model['qty_current'].'</b>' ?>
                </td>
                <!-- jml perbaikan dan jml perpindahan, tnggl totalin qty yang udah di input pada barang..
                gausah ada perhitungan minus(-) ketika input perpindahan dan perbaikan barang -->
                <td style="text-align: center;">
                    <?=
                    Html::a($model_repair ? $model_repair : '0', ['tb-assets/detail-record-repair', 'id_tb_assets' => $model['id']]);
                    ?>
                </td>
                <td style="text-align: center;">
                    <?=
                        Html::a($model_move ? $model_move : '0', ['tb-assets/detail-record-move', 'id_tb_assets' => $model['id']]);
                    ?>
                </td>
            </tr>
        </tbody>    
    </table>
</div>