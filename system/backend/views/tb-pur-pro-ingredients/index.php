<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbPurProIngredientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Pur Pro Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pur-pro-ingredients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tb Pur Pro Ingredients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_pur_pro',
            'id_ingredients',
            'qty',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
