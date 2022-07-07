<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\CommonAsset;
use app\models\Disponibilidade;
use app\models\TipoCombustivel;
use app\models\Marca;
use app\models\Modelo;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\components\GhostHtml;

CommonAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\VeiculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Veículos';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="veiculo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GhostHtml::a('Adicionar Veículo', ['create'], ['class' => 'btn btn-primary searchbtn']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'matricula:text:Matrícula',

            [
                'attribute' => 'modelo.marca.marca',
                'value' => 'modelo.marca.marca',
                'filter' => Html::activeDropDownList($searchModel, 'marca_id', ArrayHelper::map(Marca::find()->asArray()->all(),
                    'id', 'marca'), ['class' => 'form-control', 'prompt' => 'Selecionar Marca']),
                'label' => 'Marca'
            ],
            [
                'attribute' => 'modelo.modelo',
                'value' => 'modelo.modelo',
                'filter' => Html::activeDropDownList($searchModel, 'modelo_id', ArrayHelper::map(Modelo::find()->asArray()->all(),
                    'id', 'modelo'), ['class' => 'form-control', 'prompt' => 'Selecionar Modelo']),
                'label' => 'Modelo'
            ],

            'cor',

            [
                'attribute' => 'tipoCombustivel.tipo',
                'value' => 'tipoCombustivel.tipo',
                'filter' => Html::activeDropDownList($searchModel, 'tipoCombustivel_id', ArrayHelper::map(TipoCombustivel::find()->asArray()->all(),
                    'id', 'tipo'), ['class' => 'form-control', 'prompt' => 'Selecionar Combustível']),
                'label' => 'Combustível'
            ],
            'lugares',
            'capacidade_bagageira:text:Bagageira',

            [
                'attribute' => 'disponibilidade.estado',
                'value' => 'disponibilidade.estado',
                'filter' => Html::activeDropDownList($searchModel, 'disponibilidade_id', ArrayHelper::map(Disponibilidade::find()->asArray()->all(),
                    'id', 'estado'), ['class' => 'form-control', 'prompt' => 'Selecionar Disponibilidade']),
                'label' => 'Disponibilidade'
            ],
            [
                'class' => 'yii\grid\ActionColumn',

                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"  ></span> ', ['/veiculo/update', 'id' => $model->id]);
                    },
                    'view' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"  ></span> ', ['/veiculo/view', 'id' => $model->id]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"  ></span> ', ['/veiculo/delete', 'id' => $model->id],
                            [
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                            ]);
                    },
                ],

            ],
        ],
    ]); ?>


</div>
