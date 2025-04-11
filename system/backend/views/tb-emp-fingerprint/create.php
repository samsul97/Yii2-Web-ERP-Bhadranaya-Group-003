<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpFingerprint */

$this->title = 'Create Tb Emp Fingerprint';
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Fingerprints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-emp-fingerprint-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
