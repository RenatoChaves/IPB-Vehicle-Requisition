<?php

use yii\helpers\Html;
use yii\grid\GridView;
use webvimark\modules\UserManagement\components\GhostHtml;
use yii\helpers\ArrayHelper;
use app\models\Disponibilidade;
use app\models\Marca;
use app\models\Modelo;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ManutencaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manutenções';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= GhostHtml::a('Adicionar Manutenção', ['/manutencao/manutencaoindex'], ['class' => 'btn btn-primary searchbtn']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'data:text:Data da Manutenção',
            [
                'attribute' => 'utilizador.nome',
                'format' => 'text',
                'label' => 'Técnico de Manutenção',
            ],
            [
                'attribute' => 'veiculo.matricula',
                'format' => 'text',
                'label' => 'Matrícula',
            ],

            [
                'attribute' => 'veiculo.modelo.marca.marca',
                'value' => 'veiculo.modelo.marca.marca',
                'filter' => Html::activeDropDownList($searchModel, 'marca_id', ArrayHelper::map(Marca::find()->asArray()->all(),
                    'id', 'marca'), ['class' => 'form-control', 'prompt' => 'Selecionar Marca']),
                'label' => 'Marca'
            ],
            [
                'attribute' => 'veiculo.modelo.modelo',
                'value' => 'veiculo.modelo.modelo',
                'filter' => Html::activeDropDownList($searchModel, 'modelo_id', ArrayHelper::map(Modelo::find()->asArray()->all(),
                    'id', 'modelo'), ['class' => 'form-control', 'prompt' => 'Selecionar Modelo']),
                'label' => 'Modelo'
            ],
            [
                'attribute' => 'veiculo.disponibilidade.estado',
                'value' => 'veiculo.disponibilidade.estado',
                'filter' => Html::activeDropDownList($searchModel, 'disponibilidade_id', ArrayHelper::map(Disponibilidade::find()->asArray()->all(),
                    'id', 'estado'), ['class' => 'form-control', 'prompt' => 'Selecionar Disponibilidade']),
                'label' => 'Disponibilidade'
            ],

            [
                'class' => 'yii\grid\ActionColumn',

                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"  ></span> ', ['/manutencao/update', 'id' => $model->id]);
                    },
                    'view' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"  ></span> ', ['/manutencao/view', 'id' => $model->id]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"  ></span> ', ['/manutencao/delete', 'id' => $model->id],
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
