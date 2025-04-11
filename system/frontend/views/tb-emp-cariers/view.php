<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbEmpCariers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Cariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tb-emp-cariers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address:ntext',
            'email:email',
            'telp',
            'id_education',
            'id_major',
            'college',
            'ipk',
            'apprenticeship',
            'id_reference',
            'url:url',
            'yof',
            'yoo',
            'cv',
            'transcripts',
            'status',
            'created_at',
            'timestamp',
        ],
    ]) ?>

</div>
