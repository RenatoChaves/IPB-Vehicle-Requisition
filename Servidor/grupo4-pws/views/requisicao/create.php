<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requisicao */

$this->title = 'Requisitar Veículo';
$this->params['breadcrumbs'][] = ['label' => 'Escolher Veículo', 'url' => ['requisitarveiculo']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisicao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
