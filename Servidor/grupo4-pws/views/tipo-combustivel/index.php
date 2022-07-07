<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoCombustivelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Combustivels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-combustivel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tipo Combustivel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
