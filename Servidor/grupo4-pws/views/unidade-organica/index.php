<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UnidadeOrganicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unidade Organicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidade-organica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Unidade Organica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'unidadeOrganica',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
