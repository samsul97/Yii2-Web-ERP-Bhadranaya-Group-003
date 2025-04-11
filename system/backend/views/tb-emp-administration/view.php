<?php

use backend\models\MrEmpLetter;
use backend\models\TbEmployee;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

$select_employee = ArrayHelper::map(TbEmployee::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['nie']. ' - ' . $model['name'];
}
);

$select_letter = ArrayHelper::map(MrEmpLetter::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpAdministration */

$this->title = $model->no_letter;
$this->params['breadcrumbs'][] = ['label' => 'Surat Menyurat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button> -->
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-emp-administration-view">
                <p>
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                     <!-- Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) -->
                    <!-- <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?> -->
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                        // 'id_employee',
                        // 'id_letter',
                        // 'id_user',
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_employee',
                            'filter' => $select_employee,
                            'value' => function ($data) {
                                $employee = TbEmployee::findOne($data['id_employee']);
                                return $employee['nie']. '-' . $employee['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_letter',
                            'filter' => $select_letter,
                            'value' => function ($data) {
                                $letter = MrEmpLetter::findOne($data['id_letter']);
                                return $letter['name'];
                            },
                        ],
                        'no_letter',
                        'no_month',
                        'year',
                        'created_at',

                        [
                            'label' => 'Download Surat',
                            'format' => 'raw',
                            'value' => function($model){
                                // $letterType = MrEmpLetter::findAll();
                                if ($model->id_letter == 1) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-peringatan-satu', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 2) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-peringatan-dua', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 3) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-peringatan-tiga', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 4) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-mutasi', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 5) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-penetapan-demosi', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 6) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-paklaring', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 7) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-promosi', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 8) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-akting-jabatan', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                } elseif ($model->id_letter == 9) {
                                    return Html::a('<i class="fa fa-print"></i> Download Surat', ['surat-urip', 'id' => $model->id], ['class' => 'btn btn-danger btn-flat','target' => '_blank']);
                                }
                                else {
                                    return "Jenis surat tidak ada";
                                }
                            }
                        ],
                        // 'timestamp',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>