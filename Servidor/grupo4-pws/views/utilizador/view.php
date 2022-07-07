<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Utilizador */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contas de Utilizador', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Conta de Utilizador ID - '. $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="utilizador-view">

    <h1><?= Html::encode('Conta de Utilizador ID - '.$this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary searchbtn']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
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
            'id:text:ID de Utilizador',
            'nome:text:Nome',
            'apelido:text:Apelido',
            'numeroBI:text:Número de Identificação',
            'numeroMecanografico:text:Número Mecanográfico',
            'telemovel:text:Telemóvel',
            'user.email:email:E-Mail',
            'unidadeOrganica.unidadeOrganica:text:Unidade Orgânica',
        ],
    ]) ?>

</div>
