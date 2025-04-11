<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TbEmpCariersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Emp Cariers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-emp-cariers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tb Emp Cariers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'address:ntext',
            'email:email',
            'telp',
            //'id_education',
            //'id_major',
            //'college',
            //'ipk',
            //'apprenticeship',
            //'id_reference',
            //'url:url',
            //'yof',
            //'yoo',
            //'cv',
            //'transcripts',
            //'status',
            //'created_at',
            //'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
