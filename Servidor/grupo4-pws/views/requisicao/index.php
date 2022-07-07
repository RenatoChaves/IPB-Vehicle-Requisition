<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Disponibilidade;
use webvimark\modules\UserManagement\components\GhostHtml;
use app\models\Validacao;



/* @var $this yii\web\View */
/* @var $searchModel app\models\RequisicaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requisições de Veículos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisicao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'data_submit_req',
                'format'=>'text',
                'label'=> 'Data de Submissão'],
            ['attribute' => 'utilizador.nome',
                'format' => 'text',
                'label' => 'Requisitante'
            ],
            'data_req:text:Data de Requisição',
//            'data_saida:text:Data de Saída',

            [
                'attribute' => 'veiculo.matricula',
                'format' => 'text',
                'label' => 'Matrícula',
            ],

            ['attribute' => 'veiculo.modelo.marca.marca',
                'value' => 'veiculo.modelo.marca.marca',
                'label' => 'Marca'
            ],

            ['attribute' => 'veiculo.modelo.modelo',
                'value' => 'veiculo.modelo.modelo',
                'label' => 'Modelo'
            ],

//            'data_chegada:text:Data de Chegada',
//            'motivo_requisicao:text:Motivo',
            [
                'attribute' => 'veiculo.disponibilidade.estado',
                'value' => 'veiculo.disponibilidade.estado',
                'filter' => Html::activeDropDownList($searchModel, 'disponibilidade_id', ArrayHelper::map(Disponibilidade::find()->asArray()->all(), 'id', 'estado'),
                    ['class' => 'form-control', 'prompt' => 'Selecionar Disponibilidade']),
                'label' => 'Disponibilidade'
            ],

            [
                'attribute' => 'validacao.estado',
                'value' => 'validacao.estado',
                'filter' => Html::activeDropDownList($searchModel, 'validacao_id', ArrayHelper::map(Validacao::find()->asArray()->all(), 'id', 'estado'), ['class' => 'form-control', 'prompt' => 'Selecionar Estado']),
                'label' => 'Estado'
            ],

            [
                'class' => 'yii\grid\ActionColumn',

                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"  ></span> ', ['/requisicao/update', 'id' => $model->id]);
                    },
                    'view' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"  ></span> ', ['/requisicao/view', 'id' => $model->id]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"  ></span> ', ['/requisicao/delete', 'id' => $model->id],
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
