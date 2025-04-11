<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tbemptkpops */

$this->title = 'Create Tbemptkpops';
$this->params['breadcrumbs'][] = ['label' => 'Tbemptkpops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbemptkpops-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
