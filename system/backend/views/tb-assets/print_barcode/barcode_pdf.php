<?php
use yii\helpers\Html;
// use app\components\Helper;
use backend\models\TbAssets;
use barcode\barcode\BarcodeGenerator;
?>

<div id ="showBarcode"></div>
<barcode code="978-0-9542246-0" type="ISBN" height="0.66" text="1" />

<div class="barcodecell"><barcode code="54321068" type="I25" class="barcode" /></div>

<table class="table-pdf" style="margin:auto; width:100%;">
	<thead>
		<tr>
			<th><?= strtoupper("Nama") ?></th>
            <th><?= strtoupper("SKU") ?></th>
			<th><?= strtoupper("Barcode") ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($model as $data) { ?>
		<tr>
			<td><?= $data->name ?></td>
			<td><?= $data->sku ?></td>
			<td>
			<?php 
			
			$elementId = 'showBarcode' . '-' . $data['sku'];
				$value = $data['sku'];
				$type = 'code39';
				BarcodeGenerator::widget(array('elementId' => $elementId, 'value' => $value, 'type' => $type));
				// 	echo '<div id="showBarcode-'.$data['sku'].'"></div>';
				Html::tag('div', '', ['id' => 'showBarcode-'.$data['sku']]);
				// BarcodeGenerator::widget([
				// 	'elementId' => 'showBarcode'.$data['sku'], // test 1
				// 	// 'elementId' => $data['sku'], // test 2
				// 	'value'     => $data['sku'], 
				// 	'type'      => 'code39',
				// ]);
				//   Html::tag('div', '', ['id' => 'showBarcode-'.$data['sku']]);
			?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
