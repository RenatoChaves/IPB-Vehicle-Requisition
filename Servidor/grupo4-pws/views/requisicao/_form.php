<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\Veiculo;
use app\models\VeiculoSearch;
use app\models\Utilizador;
use app\models\UtilizadorSearch;
use app\models\User;
use app\models;
use yii\helpers\ArrayHelper;
use app\models\Requisicao;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Requisicao */
/* @var $form yii\widgets\ActiveForm */

//$query = Utilizador::
?>

<div class="requisicao-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'data_req')->widget(
        DateTimePicker::ClassName(), [
            //                    'inline'=>true,
            //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd - HH:ii'
        ]]
    )->label('Data de Requisição'); ?>

    <?= $form->field($model, 'motivo_requisicao')->textarea(['autocomplete' => 'off','maxlength' => true]) ?>

    <?= $form->field($model->veiculo,'matricula')->textInput(['readonly' => 'true']) ?>

    <?= $form->field($model->veiculo->modelo->marca,'marca')->textInput(['readonly' => 'true']) ?>

    <?= $form->field($model->veiculo->modelo,'modelo')->textInput(['readonly' => 'true']) ?>




    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary searchbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
