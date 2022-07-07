<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Veiculo */

$this->title = 'Editar Veículo ID - ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Veículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Veículo ID - '.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="veiculo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
