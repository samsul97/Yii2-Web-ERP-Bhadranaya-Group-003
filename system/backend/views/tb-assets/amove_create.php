<?php

use backend\models\MrTkp;
use backend\models\TbAssets;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;

$select_assets = ArrayHelper::map(TbAssets::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'].'-' .$model['sku'];;
}
);

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
/* @var $this yii\web\View */
/* @var $model backend\models\TbAssets */

$this->title = 'Tambah Barang Pindah';
$this->params['breadcrumbs'][] = ['label' => 'Barang Pindah', 'url' => ['broken']];
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
			<div class="tb-assets-move-create">
                <div class="tb-assets-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= Html::label('Barang', 'assets', ['class' => 'control-label']) ?>
                    <?= Select2::widget([
                        'id' => 'assets',
                        'name' => 'assets',
                        'data' => $select_assets,
                        'value' => $model,
                        'options' => [
                            'placeholder' => 'Pilih Barang',
                            'onChange' => '$.post("'.Url::base().'/tb-assets/select?id='.'" + $(this).val(), function(data) {
                                    what = JSON.parse(data);
                                    $("#qty_now").val(what.qty_now);
                                    $("#tkp_now").html(what.tkp_now);
                                }
                            );',
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]) ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- <div id="select_assets" style="display: none"> -->
                                <!-- Jumlah Barang Normal -->
                                <?= Html::label('Jumlah Saat Ini', 'qty_now', ['class' => 'control-label']) ?>
                                <input type="text" class="form-control" value="<?= $currents['qty_current'] ? $currents['qty_current'] : '0' ?>" name="qty_now" id="qty_now" readonly="true">
                                <!-- Tkp Sebelumnya -->
                                <?= Html::label('Posisi Barang Saat Ini', 'tkp_now', ['class' => 'control-label']) ?>
                                <?= Select2::widget([
                                    'id' => 'tkp_now',
                                    'name' => 'tkp_now',
                                    'data' => $select_tkp,
                                    'value' => $currents['id_tkp'] ? $currents['id_tkp'] : '0',
                                    'options' => [
                                        'placeholder' => '0',
                                        // 'disabled' => true,
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                                ]) ?>
                            <!-- </div> -->
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'qty_move')->textInput(['type' => 'number', 'min' => 0, 'value' => $model->isNewRecord ? 0 : null]) ?>
                            <?= $form->field($model, 'id_tkp')->widget(Select2::classname(),[
                                    'data' => $select_tkp,
                                    'options' => [
                                        'placeholder' => 'Pilih TKP Tujuan',
                                        'value' => $model->isNewRecord ? 0 : $model->id_tkp,
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                                ]);
                            ?>
                            </div>
                        </div>
                    </div>
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
/* Isi Js disini.... */
JS;

$css = <<< CSS
/* Isi Css disini.... */
CSS;

$this->registerJs($js);
$this->registerCss($css);