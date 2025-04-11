<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbPurSuppverif */

$this->title = 'Surat Penawaran Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Penawaran Vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pur-suppvletter-create">
    
    <center><h2 class="card-title"><?= Html::encode($this->title) ?></h2></center>
    
    <?= $this->render('letter_form', [
        'model' => $model,
    ]) ?>
    
    <div class="container">
        <img src="<?= Yii::getAlias('@web').'/frontend/img_static/bhadranaya.png' ?>" style="width: 100%; height:auto; display: block; margin: 0">
    </div>

</div>
