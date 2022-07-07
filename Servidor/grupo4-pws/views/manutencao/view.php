<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manutencao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manutenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Manutenção ID - ' . $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manutencao-view">

    <h1><?= Html::encode('Manutenção ID - '.$this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary searchbtn']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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
            'id:text:ID da Manutenção',
            'utilizador.nome:text:Técnico de Manutenção',
            'data:text:Data da Manutenção',
            'km_saida:text:Quilómetros de Saída',
            'km_chegada:text:Quilómetros de Chegada',
            'observacoes:text:Observações',
            'requisicao_id:text:ID da Requisição',
            'data_inspecao:text:Data de Inspeção',
            'veiculo.matricula:text:Matrícula',
            'veiculo.modelo.marca.marca:text:Marca',
            'veiculo.modelo.modelo:text:Modelo',
        ],
    ]) ?>

</div>
