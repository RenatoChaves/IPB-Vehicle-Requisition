<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use webvimark\modules\UserManagement\components\GhostHtml;

/* @var $this yii\web\View */
/* @var $model app\models\Requisicao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisições', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Requisição ID - '.$this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="requisicao-view">

    <h1><?= Html::encode('Requisição ID - '.$this->title) ?></h1>

    <p>
        <?= GhostHtml::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary searchbtn']) ?>
        <?= GhostHtml::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'value' => $model->utilizador->nome,
                'label' => 'Requisitante',
            ],

            [
                'value' => $model->data_req,
                'label' => 'Data de Requisição',
            ],
            [
                'value' => $model->veiculo->matricula,
                'label' => 'Matrícula',
            ],
            [
                'value' => $model->veiculo->modelo->marca->marca,
                'label' => 'Marca',
            ],
            [
                'value' => $model->veiculo->modelo->modelo,
                'label' => 'Modelo',
            ],
            [
                'value' => $model->motivo_requisicao,
                'label' => 'Motivo de Requisição',
            ],
            [
                'value' => $model->data_saida,
                'label' => 'Data de Saída',
            ],
            [
                'value' => $model->km_saida,
                'label' => 'Km de Saída',
            ],
            [
                'value' => $model->data_chegada,
                'label' => 'Data de Chegada',
            ],
            [
                'value' => $model->km_chegada,
                'label' => 'Km de Chegada',
            ],
            [
                'value' => $model->veiculo->disponibilidade->estado,
                'label' => 'Estado de Disponibilidade do Veículo',
            ],
            [
                'value' => $model->validacao->estado,
                'label' => 'Estado da Requisição',
            ],
        ],
    ]) ?>

</div>
