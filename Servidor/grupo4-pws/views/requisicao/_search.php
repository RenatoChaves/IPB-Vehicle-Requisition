<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DateRangePicker;
use dosamigos\datetimepicker\DateTimePicker;

$js=<<< JS
        $("a.advance_search").on('click',function(e){
           e.preventDefault();
            var x = document.getElementById("toggleSearch");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        });
JS;
$this->registerJs($js,\yii\web\view::POS_READY);
/* @var $this yii\web\View */
/* @var $model app\models\RequisicaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<?= Html::a('<i class="fa fa-search-plus"></i>' . Yii::t('app', ' Mostrar pesquisa avançada'), '#.', ['class' => 'advance_search btn btn-block btn-warning']) ?>
<div id="toggleSearch" class="container" style="display:none">
<div class="requisicao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php  echo $form->field($model, 'utilizador_id',['options' => ['class' => 'col-md-6']])->label('Requisitante') ?>

    <?= $form->field($model, 'motivo_requisicao', ['options' => ['class' => 'col-md-6']])->label('Motivo de Requisição') ?>

    <?php  echo $form->field($model, 'km_saida_min', ['options' => ['class' => 'col-md-6']])->label('Km de Saída de') ?>

    <?php  echo $form->field($model, 'km_saida_max',['options' => ['class' => 'col-md-6']])->label('Km de Saída até') ?>

    <?php  echo $form->field($model, 'km_chegada_min',['options' => ['class' => 'col-md-6']])->label('Km de Chegada de') ?>

    <?php  echo $form->field($model, 'km_chegada_max',['options' => ['class' => 'col-md-6']])->label('Km de Chegada até') ?>

    <?= $form->field($model, 'data_submit_req_from',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - hh:ii'
        ]])->label('Data de Submissão da Requisição De:')?>

    <?= $form->field($model, 'data_submit_req_to',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - hh:ii'
        ]])->label('Data de Submissão da Requisição Até:')?>

    <?= $form->field($model, 'data_req_from',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - hh:ii'
        ]])->label('Data de Requisição De:')?>

    <?= $form->field($model, 'data_req_to',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - hh:ii'
        ]])->label('Data de Requisição Até:') ?>

    <?= $form->field($model, 'data_saida_from',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - H:i:s'
        ]])->label('Data de Saída De:')?>

    <?= $form->field($model, 'data_saida_to',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - H:i:s'
        ]])->label('Data de Saída Até:') ?>

    <?= $form->field($model, 'data_chegada_from',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - H:i:s'
        ]])->label('Data de Chegada De:')?>

    <?= $form->field($model, 'data_chegada_to',['options' => ['class' => 'col-md-6']])->widget(
        DateTimePicker::ClassName(), [
        //                    'inline'=>true,
        //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

        'clientOptions' => ['autocomplete' => 'off',
            'autoclose' => true,

            'format' => 'yyyy-mm-dd - H:i:s'
        ]])->label('Data de Chegada Até:') ?>

    <div class="form-group formbutoes">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary searchbtn']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>