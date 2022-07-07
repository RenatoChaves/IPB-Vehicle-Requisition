<?php

use yii\helpers\Html;
use yii\grid\GridView;
use webvimark\modules\UserManagement\components\GhostHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UtilizadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contas de Utilizador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizador-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'apelido',
            'numeroMecanografico:text:Número Mecanográfico',
            'telemovel:text:Telemóvel',
            [
                'attribute' => 'user.email',
                'format' => 'text',
                'label' => 'E-Mail',
            ],
            'user_id:text:Username',
            [
                'attribute' => 'user.username',
                'format' => 'text',
                'label' => 'Username',
            ],

            [
                'class' => 'yii\grid\ActionColumn',

                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"  ></span> ', ['/utilizador/update', 'id' => $model->id]);
                    },
                    'view' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"  ></span> ', ['/utilizador/view', 'id' => $model->id]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return GhostHtml::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"  ></span> ', ['/utilizador/delete', 'id' => $model->id],
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
