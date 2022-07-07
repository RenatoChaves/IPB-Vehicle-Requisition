<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManutencaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manutencao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'km_saida') ?>

    <?= $form->field($model, 'km_chegada') ?>

    <?= $form->field($model, 'observacoes') ?>

    <?php // echo $form->field($model, 'data_inspecao') ?>

    <?php // echo $form->field($model, 'veiculo_id') ?>

    <?php // echo $form->field($model, 'requisicao_id') ?>

    <?php // echo $form->field($model, 'utilizador_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
