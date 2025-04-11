<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter3Sosmed */

$this->title = 'Update Set Fe Footer3 Sosmed: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer3 Sosmeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-fe-footer3-sosmed-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
