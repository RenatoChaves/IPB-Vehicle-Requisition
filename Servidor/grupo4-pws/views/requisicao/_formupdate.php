<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\Veiculo;
use app\models\Modelo;
use app\models\Marca;
use app\models\VeiculoSearch;
use app\models\Utilizador;
use app\models\UtilizadorSearch;
use app\models\User;
use app\models;
use yii\helpers\ArrayHelper;
use app\models\Requisicao;
use app\models\Validacao;
use app\models\Disponibilidade;

/* @var $this yii\web\View */
/* @var $model app\models\Requisicao */
/* @var $form yii\widgets\ActiveForm */

$validacao_id = Validacao::find()->all();
$modelo = Modelo::find()->all();
$marca = Marca::find()->all();
$disponibilidade_id = Disponibilidade::find()->all();

$listaValidacao = ArrayHelper::map($validacao_id, 'id','estado');
$listaDisponibilidade = ArrayHelper::map($disponibilidade_id, 'id', 'estado');
$listaModelo = ArrayHelper::map($modelo, 'id', 'modelo');


?>

<div class="requisicao-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'data_req')->widget(
        DatePicker::ClassName(), [
            //                    'inline'=>true,
            //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
        ]]
    )->label('Data de Requisição'); ?>

    <?= $form->field($model, 'data_saida')->widget(
            DatePicker::ClassName(), [
            //                    'inline'=>true,
            //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]]
    )->label('Data de Saída'); ?>

    <?= $form->field($model, 'data_chegada')->widget(
        DatePicker::ClassName(), [
            //                    'inline'=>true,
            //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

            'clientOptions' => ['autocomplete' => 'off',
                'autoclose' => true,

                'format' => 'yyyy-mm-dd'
            ]]
    )->label('Data de Chegada'); ?>

    <?= $form->field($model, 'motivo_requisicao')->textInput(['autocomplete' => 'off','maxlength' => true]) ?>

    <?= $form->field($model, 'km_saida')->textInput(['autocomplete' => 'off']) ?>

    <?= $form->field($model, 'km_chegada')->textInput(['autocomplete' => 'off']) ?>

    <?= $form->field($model->veiculo,'matricula')->textInput(['readonly' => 'true']) ?>

    <?= $form->field($model->veiculo->modelo->marca,'marca')->textInput(['readonly' => 'true']) ?>

    <?= $form->field($model->veiculo->modelo,'modelo')->textInput(['readonly' => 'true']) ?>

    <?= $form->field($model, 'validacao_id')
        ->dropDownList($listaValidacao,['prompt' => 'Estado...'])
        ->label('Estado da Requisição') ?>




    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary searchbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
