<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\TbEmployee;
use yii\helpers\ArrayHelper;

$select_employee = ArrayHelper::map(TbEmployee::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['nie']. ' - ' . $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpLeave */

$this->title = $model->leave_type;
$this->params['breadcrumbs'][] = ['label' => 'Data Cuti', 'url' => ['index']];
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
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-emp-leave-view">
                <p>
                    <?= Html::a('Kembali', ['create'], ['class' => 'btn btn-warning']) ?>
                    <!-- Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) -->
                    <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                        // 'id_employee',
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
                        'leave_type',
                        'leave_type_special',
                        'start_date',
                        'till_date',
                        'reason',
                        'dof',
                        'timestamp',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
