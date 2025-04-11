<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter2Testimony */

$this->title = 'Create Set Fe Footer2 Testimony';
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer2 Testimonies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-footer2-testimony-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
