<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbPurSuppverif */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tb Pur Suppverifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tb-pur-suppverif-view">

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
            'type_business',
            'img_nib',
            'img_npwp',
            'img_directur',
            'name',
            'residence_address:ntext',
            'letter_address:ntext',
            'telp',
            'facsimile',
            'email:email',
            'id_tb_bf',
            'id_bank',
            'account_number',
            'swift_code',
            'payment_method',
            'offering_letter',
            'created_at',
        ],
    ]) ?>

</div>
