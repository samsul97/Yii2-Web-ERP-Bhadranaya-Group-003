<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter3About */

$this->title = 'Update Set Fe Footer3 About: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer3 Abouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-fe-footer3-about-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
