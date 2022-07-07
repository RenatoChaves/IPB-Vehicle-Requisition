<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoCombustivel;
use app\models\Disponibilidade;
use app\models\Modelo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Veiculo */
/* @var $form yii\widgets\ActiveForm */


$combustivel = tipoCombustivel::find()->all();
$disponibilidade = Disponibilidade::find()->all();
$modelo = Modelo::find()->all();

$listaCombustivel = ArrayHelper::map($combustivel, 'id', 'tipo');
$listaDisponibilidade = ArrayHelper::map($disponibilidade,'id','estado');
$listaModelo = ArrayHelper::map($modelo,'id', 'modelo');
?>

<div class="veiculo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matricula')
        ->textInput(['maxlength' => true])
        ->label('Matrícula :')?>

    <?= $form->field($model, 'cor')
        ->textInput(['maxlength' => true])
        ->label('Cor :')?>

    <?= $form->field($model, 'capacidade_bagageira')
        ->textInput(['maxlength' => true])
        ->label('Capacidade de Bagageira :')?>

    <?= $form->field($model, 'lugares')
        ->textInput(['maxlength' => true])
        ->label('Lugares :')?>

    <?= $form->field($model, 'modelo_id')
        ->dropDownList($listaModelo,['prompt' => 'Escolha...'])
        ->label('Modelo :')?>

    <?= $form->field($model, 'tipoCombustivel_id')
        ->dropDownList($listaCombustivel,['prompt' => 'Escolha...'])
        ->label('Tipo de Combustível :')?>

    <?= $form->field($model, 'disponibilidade_id')
        ->dropDownList($listaDisponibilidade,['prompt' => 'Escolha...'])
        ->label('Disponibilidade :')?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary searchbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
