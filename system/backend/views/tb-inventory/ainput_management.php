<?php

use backend\models\MrInParent;
use backend\models\MrInType;
use backend\models\MrInUnit;
use backend\models\TbInventory;
use backend\models\TbInvManagement;
use backend\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $inv_management backend\models\TbInvManagement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Input Inventori';
$this->params['breadcrumbs'][] = $this->title;
$type = MrInType::findOne($select_inv['id_in_type']);
$parent = MrInParent::findOne($select_inv['id_in_parent']);
$unit = MrInUnit::findOne($select_inv['id_in_unit']);
$user = User::findOne($select_inv['id_user']);
// $today = TbInvManagement::find()->where(['id_inventory' => $select_inv->id, 'updated_at' => date('Y-m-d')])->one();
// $yesterday = TbInvManagement::find()->where(['id_inventory' => $check_inventory->id, 'updated_at' => date('Y-m-d', strtotime('-1 day'))])->one();
// var_dump($yesterday);
// die;
// if ($today) {
//     echo "<pre>";
//     echo $today->begin_stock, 'STOCK HARI INI';
// } 
// if ($yesterday) {
//     echo "<pre>";
//     echo $yesterday->begin_stock, 'STOCK AKHIR KEESOKANYA (ACUAN LAST STOCK TB INVENTORY))';
// }
?>
<div class="card table-card">
    <div class="card-header" style="background-color: #dcdde1; text-align: justify; letter-spacing: 1px;">
        <h5 class="card-title">Semua jenis daging. Pencatatan datang barang dalam satuan kilogram (KG). Konversi ke satuan pieces (PCS). Sisa potongan yang tidak sesuai standar (Bad Cutting mentah) dimasukan kedalam kolom Waste, dengan satuan gram (GR)
        OUT NON SALES: Semua jenis pengeluaran bahan yang tidak melalui penjualan,yaitu: Promo free item, compliment (liputan atau customer complaint), bahan spoiled (rusak, basi, kadaluarsa, tidak layak disajikan)</h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>

    <div class="card-body">
        <div class="card-text">
            <div class="tb-inv-management-form">
                <div class="table-responsive table-nowrap">
                <?php if ($check_inventory): ?>
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-lg-3">
                        <p><b>Nama Barang : </b> <?= $select_inv->desc ?></p>
                        <p><b>Jenis : </b> <?= $type->name ?></p>
                        </div>
                        <div class="col-lg-3">
                        <p>
                            <b>Stok Awal : </b>
                            <?php
                            $check_date = TbInvManagement::find()->where(['id_inventory' => $select_inv->id])->one();
                            $today = date('Y-m-d');
                            $nextdays = date('Y-m-d', strtotime($today . '+1 day'));
                            if ($nextdays) {
                                echo $check_date->last_stock . '(GRAM)';
                            }
                            elseif ($check_date) {
                                echo $check_date->begin_stock . ' (GRAM)';
                            }
                            ?>
                        </p>
                        <p><b>Stok Akhir : </b> <?php echo $check_inventory->last_stock . ' (GRAM)' ?></p>
                        </div>
                        <div class="col-lg-3">
                        <p><b>Induk : </b> <?= $parent->name ?></p>
                        <p><b>Unit : </b> <?= $unit->name ?></p>
                        </div>
                        <div class="col-lg-3">
                        <p><b>User : </b> <?= $user->name ?></p>
                        <p><b>Tanggal : </b> <?= date('Y-m-d') ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->
                        <div class="col-lg-4">
                            <?= $form->field($check_inventory, 'in_arrival', [ 'template' => '
                                {label}
                                <div class="input-group">
                                {input}
                                <span class="input-group-text" id="basic-addon1">KG</span>
                                </div>
                                {hint}
                                {error}',
                                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Input Datang', 'value' => $check_inventory->in_arrival ? $check_inventory->in_arrival : '0', 'readonly' => $check_inventory->in_arrival ? true : false])
                            ?>

                            <?= $form->field($check_inventory, 'out_non_sales', [ 'template' => '
                                {label}
                                <div class="input-group">
                                {input}
                                <span class="input-group-text" id="basic-addon1">GRAM</span>
                                </div>
                                {hint}
                                {error}',
                                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Out Non Sales', 'readonly' => $check_inventory->out_non_sales ? true : false, 'value' => $check_inventory->out_non_sales ? $check_inventory->out_non_sales : 0])
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($check_inventory, 'in_selling', [ 'template' => '
                                {label}
                                <div class="input-group">
                                {input}
                                <span class="input-group-text" id="basic-addon1">GRAM</span>
                                </div>
                                {hint}
                                {error}',
                                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Input Jual', 'readonly' => $check_inventory->in_selling ? true : false, 'value' => $check_inventory->in_selling ? $check_inventory->in_selling : 0])
                            ?>

                            <?= $form->field($check_inventory, 'waste', [ 'template' => '
                                {label}
                                <div class="input-group">
                                {input}
                                <span class="input-group-text" id="basic-addon1">GRAM</span>
                                </div>
                                {hint}
                                {error}',
                                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Waste', 'readonly' => $check_inventory->waste ? true : false, 'value' => $check_inventory->waste ? $check_inventory->waste : 0])
                            ?>    
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($check_inventory, 'out_sales', [ 'template' => '
                                {label}
                                <div class="input-group">
                                {input}
                                <span class="input-group-text" id="basic-addon1">GRAM</span>
                                </div>
                                {hint}
                                {error}',
                                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Out Sales', 'readonly' => $check_inventory->out_sales ? true : false, 'value' => $check_inventory->out_sales ? $check_inventory->out_sales : 0])
                            ?>

                            <?= $form->field($check_inventory, 'spoiled', [ 'template' => '
                                {label}
                                <div class="input-group">
                                {input}
                                <span class="input-group-text" id="basic-addon1">GRAM</span>
                                </div>
                                {hint}
                                {error}',
                                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Spoiled', 'readonly' => $check_inventory->spoiled ? true : false, 'value' => $check_inventory->spoiled ? $check_inventory->spoiled : 0])
                            ?>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($check_inventory, 'remarks')->textarea(['maxlength' => true, 'rows' => 6, 'placeholder' => 'Catatan Stok', 'value' => $check_inventory->remarks ? $check_inventory->remarks : 0]) ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    
                    <?php elseif($inv_management) :?>
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col-lg-3">
                            <p><b>Nama Barang : </b> <?= $select_inv->desc ?></p>
                            <p><b>Jenis : </b> <?= $type->name ?></p>
                            </div>
                            <div class="col-lg-3">
                            <p><b>Stok Awal : </b> <?= $inv_management->begin_stock ? $inv_management->begin_stock : 0 . ' (GRAM)' ?></p>
                            <p><b>Stok Akhir : </b> <?= $inv_management->last_stock ? $inv_management->begin_stock : 0 . ' (GRAM)' ?></p>
                            </div>
                            <div class="col-lg-3">
                            <p><b>Induk : </b> <?= $parent->name ?></p>
                            <p><b>Unit : </b> <?= $unit->name ?></p>
                            </div>
                            <div class="col-lg-3">
                            <p><b>User : </b> <?= $user->name ?></p>
                            <p><b>Tanggal : </b> <?= date('Y-m-d') ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-lg-12"> -->
                            <div class="col-lg-4">
                                <?= $form->field($inv_management, 'in_arrival', [ 'template' => '
                                    {label}
                                    <div class="input-group">
                                    {input}
                                    <span class="input-group-text" id="basic-addon1">KG</span>
                                    </div>
                                    {hint}
                                    {error}',
                                    'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Input Datang'])
                                ?>

                                <?= $form->field($inv_management, 'out_non_sales', [ 'template' => '
                                    {label}
                                    <div class="input-group">
                                    {input}
                                    <span class="input-group-text" id="basic-addon1">GRAM</span>
                                    </div>
                                    {hint}
                                    {error}',
                                    'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Out Non Sales'])
                                ?>
                            </div>
                            <div class="col-lg-4">
                                <?= $form->field($inv_management, 'in_selling', [ 'template' => '
                                    {label}
                                    <div class="input-group">
                                    {input}
                                    <span class="input-group-text" id="basic-addon1">GRAM</span>
                                    </div>
                                    {hint}
                                    {error}',
                                    'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Input Jual'])
                                ?>

                                <?= $form->field($inv_management, 'waste', [ 'template' => '
                                    {label}
                                    <div class="input-group">
                                    {input}
                                    <span class="input-group-text" id="basic-addon1">GRAM</span>
                                    </div>
                                    {hint}
                                    {error}',
                                    'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Waste'])
                                ?>    
                            </div>
                            <div class="col-lg-4">
                                <?= $form->field($inv_management, 'out_sales', [ 'template' => '
                                    {label}
                                    <div class="input-group">
                                    {input}
                                    <span class="input-group-text" id="basic-addon1">GRAM</span>
                                    </div>
                                    {hint}
                                    {error}',
                                    'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Out Sales'])
                                ?>

                                <?= $form->field($inv_management, 'spoiled', [ 'template' => '
                                    {label}
                                    <div class="input-group">
                                    {input}
                                    <span class="input-group-text" id="basic-addon1">GRAM</span>
                                    </div>
                                    {hint}
                                    {error}',
                                    'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Spoiled'])
                                ?>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $form->field($inv_management, 'remarks')->textarea(['maxlength' => true, 'rows' => 6, 'placeholder' => 'Catatan Stok']) ?>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>