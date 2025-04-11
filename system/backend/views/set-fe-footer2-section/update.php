<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter2Section */

$this->title = 'Update Set Fe Footer2 Section: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer2 Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-fe-footer2-section-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
