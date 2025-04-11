<?php
use yii\helpers\Html;

/* load the required classes */
require_once Yii::getAlias('@webroot/dist/phpxbase/Column.class.php');
require_once Yii::getAlias('@webroot/dist/phpxbase/Record.class.php');
require_once Yii::getAlias('@webroot/dist/phpxbase/Table.class.php');

$this->params['breadcrumbs'][] = ['label' => 'Rincian Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title = 'Rincian Item Yang Terjual';
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
			<div class="compliment-sales-tkp">
				<div class="row">
					<div class="col">
                        <!-- <p>Rincian Item</p> -->
                        <h1>Daftar Nilai Mahasiswa</h1>
                        <table width="100%" border="1">
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>NAMA</th>
                                <th>NILAI</th>
                            </tr>
                            <?php
                            /* buat object table dan buka */
                            $table = new XBaseTable(Yii::getAlias('@webroot/dist/phpxbase/mahasiswa.dbf'));
                            $table->open();

                            $row = 1;
                            while ($record=$table->nextRecord()) {
                                echo "<tr>";
                                echo "<td>".$row++."</td>";
                                foreach ($table->getColumns() as $i=>$c) {
                                    echo "<td>".$record->getString($c)."</td>";
                                }
                                echo "</tr>";
                            } //end while

                            $table->close();
                            ?>
                        </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>