<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssetsReturn */

$this->title = 'Create Tb Assets Return';
$this->params['breadcrumbs'][] = ['label' => 'Tb Assets Returns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-assets-return-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
