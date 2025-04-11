<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MpGradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbemptkpops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbemptkpops-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbemptkpops', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_receipt',
            'id_tkp_from',
            'id_tkp_destination',
            'id_user',
            //'pic',
            //'necessity',
            //'note:ntext',
            //'deadline',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
