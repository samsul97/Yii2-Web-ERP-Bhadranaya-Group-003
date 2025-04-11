<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TbPurSuppverifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Pur Suppverifs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pur-suppverif-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tb Pur Suppverif', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type_business',
            'img_nib',
            'img_npwp',
            'img_directur',
            //'name',
            //'residence_address:ntext',
            //'letter_address:ntext',
            //'telp',
            //'facsimile',
            //'email:email',
            //'id_tb_bf',
            //'id_bank',
            //'account_number',
            //'swift_code',
            //'payment_method',
            //'offering_letter',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
