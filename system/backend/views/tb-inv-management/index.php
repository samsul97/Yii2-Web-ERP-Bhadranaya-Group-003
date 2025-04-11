<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbInvManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Inv Managements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-inv-management-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tb Inv Management', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'in_arrival',
            'in_selling',
            'out_sales',
            'out_non_sales',
            //'waste',
            //'spoiled',
            //'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
