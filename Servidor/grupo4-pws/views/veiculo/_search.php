<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Marca;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\VeiculoSearch */
/* @var $form yii\widgets\ActiveForm */

$modelMarca = Marca::find()->all();

?>

<div class="veiculo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'matricula') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'cor') ?>

    <?= $form->field($model, 'capacidade_bagageira') ?>

    <?= $form->field($model, 'lugares') ?>

    <?php // echo $form->field($model, 'modelo_id') ?>

    <?php // echo $form->field($model, 'tipoCombustivel_id') ?>

    <?php // echo $form->field($model, 'disponibilidade_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
