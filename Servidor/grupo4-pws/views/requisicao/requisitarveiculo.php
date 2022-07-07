<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\CommonAsset;
use app\models\Veiculo;
use yii\grid\ActionColumn;
use kartik\icons\Icon;
use yii\helpers\Url;


CommonAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\VeiculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requisitar Veiculos';
$this->params['breadcrumbs'][] = $this->title;
global $veiculo12;



?>
<div class="veiculo-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]);

    $items = [

        ['label' => Icon::show('home') . 'Home', 'url' => ['/site/index']],

    ];

    ?>

    <?= GridView::widget([

            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'matricula:text:Matrícula',

                    ['attribute' => 'modelo.marca.marca',
                    'format' => 'text',
                    'label' => 'Marca'
                ],

                ['attribute' => 'modelo.modelo',
                    'format' => 'text',
                    'label' => 'Modelo'
                ],
                
                ['attribute' => 'tipoCombustivel.tipo',
                    'format' => 'text',
                    'label' => 'Combustível'
                ],
                'lugares',
                'capacidade_bagageira:text:Bagageira',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'requisitar' => function ($url, $model, $key) {


                            return Html::a('<span class="btn glyphicon glyphicon-road text-primary" aria-hidden="true"  ></span> ', ['/requisicao/create', 'id' => $model->id]);
                        },
                    ],
                    'template' => '{requisitar}'
                ],
            ]]);


    ?>




</div>







