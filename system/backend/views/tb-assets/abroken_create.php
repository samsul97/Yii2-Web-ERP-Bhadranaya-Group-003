<?php

use backend\models\TbAssets;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;

$select_assets = ArrayHelper::map(TbAssets::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name']. '-' .$model['sku'];
}
);
/* @var $this yii\web\View */
/* @var $model backend\models\TbAssets */

$this->title = 'Tambah Barang Rusak';
$this->params['breadcrumbs'][] = ['label' => 'Barang Rusak', 'url' => ['broken']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="tb-assets-broken-create">
                <div class="tb-assets-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= HTml::label('Barang', 'assets', ['class' => 'control-label']) ?>
                    <?= Select2::widget([
                        'id' => 'assets',
                        'name' => 'assets',
                        'data' => $select_assets,
                        'value' => $model,
                        'options' => [
                            'placeholder' => 'Pilih Barang',
                            'onChange' => '$.post("'.Url::base().'/tb-assets/select?id='.'" + $(this).val(), function(data) {
                                    what = JSON.parse(data);
                                    console.log(what);
                                    $("#qty_now").val(what.qty_now);
                                }
                            );',
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]) ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- <div id="qty_select_assets" style="display: none"> -->
                                <!-- Jumlah Barang Normal -->
                                <?= Html::label('Jumlah Saat Ini', 'qty_now', ['class' => 'control-label']) ?>
                                <input type="text" class="form-control" value="<?= $currents['qty_current'] ? $currents['qty_current'] : '0' ?>" name="qty_now" id="qty_now" readonly="true">
                            <!-- </div> -->
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'qty_broken')->textInput(['type' => 'number', 'min' => 0, 'value' => $model->isNewRecord ? 0 : null]) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'condition_issue')->textarea(['rows' => 6, 'placeholder' => 'Deskripsi Kerusakan Barang']) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-warning']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
			</div>
		</div>
	</div>
</div>

<?php
$js = <<< JS

// $('#aset').on('change', function (e) {
//     let data = $(this).val();
//     alert($(this).val());
//     $("#qty_select_assets").show();
//         // jika pilih barang maka muncul form qty sesuai barang yang dplih 
//         // if(data == selectData) {
//         //     $("#qty_select_assets").show();
//         // }
//         // $('#tbassets-sku').val(data);
//     // });
// });

JS;

$css = <<< CSS
/* Isi Css disini.... */
CSS;

$this->registerJs($js);
$this->registerCss($css);