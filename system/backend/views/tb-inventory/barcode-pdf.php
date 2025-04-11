<?php
use yii\helpers\Html;
// use app\components\Helper;
use backend\models\TbAssets;
use backend\models\TbInventory;
use barcode\barcode\BarcodeGenerator;
$this->registerJsFile('@web/dist/js/jspdf.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = ['label' => 'Print Barcode', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title = 'Print Barcode';
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
			<!-- <form> -->
				<div id="printArea">
					<!-- Test -->
					<?php
					// $datas = TbInventory::find()->where(['id_user' => $user])->all();
					echo '<div class="row">';
						// echo '<div class="col-lg-3">';
					
					foreach ($datas as $key => $data) {
						$elementId = 'showBarcode' . '-' . $data['sku'];
						$value = $data['sku'];
						$type = 'code128';
						BarcodeGenerator::widget(array('elementId' => $elementId, 'value' => $value, 'type' => $type));
						
						echo  '<div class="card" style="color: red;">';
						echo  '<div class="card-body" style="padding: 8px; margin: 5px; border: 1px solid #1C6EA4;">';
						echo '<div class="col-lg-12">';
						echo $data['desc'];
						echo '<div id="showBarcode-'.$data['sku'].'"></div>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						
					}
					echo '</div>';
					// echo '</div>';
					?>
				</div>
				<!-- <input type="button" onclick="printDiv('samsulhadi')" value="print a div!" /> -->
				<button id="print" class="btn btn-primary">Cetak Barcode</button>
			<!-- </form> -->
		</div>
	</div>
</div>

<?php
$js = <<< JS

$('#print').on('click', function(e){
	var printContents = document.getElementById('printArea').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

    window.print();

     document.body.innerHTML = originalContents;
});

JS;
$this->registerJs($js);

?>