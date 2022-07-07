 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Veiculo;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use app\models\Disponibilidade;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Manutencao */
/* @var $form yii\widgets\ActiveForm */

 $veiculos = Veiculo::find()->all();
 $disponibilidade = Disponibilidade::find()->all();

 $listaVeiculos = ArrayHelper::map($veiculos, 'id', 'disponibilidade_id');
 $lista = ArrayHelper::map($disponibilidade, 'id', 'estado');

 ?>

<div class="manutencao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->widget(
        DateTimePicker::ClassName(), [
            //                    'inline'=>true,
            //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

            'clientOptions' => ['autocomplete' => 'off',
                'autoclose' => true,

                'format' => 'yyyy-mm-dd hh:ii:ss'
            ]]
    )->label('Data de Manutenção'); ?>

    <?= $form->field($model, 'km_saida')->textInput(['autocomplete' => 'off']) ?>

    <?= $form->field($model, 'km_chegada')->textInput(['autocomplete' => 'off']) ?>

    <?= $form->field($model, 'observacoes')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'data_inspecao')->widget(
        DatePicker::ClassName(), [
            //                    'inline'=>true,
            //                    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',

            'clientOptions' => ['autocomplete' => 'off',
                'autoclose' => true,

                'format' => 'yyyy-mm-dd'
            ]]
    )->label('Data de Inspeção'); ?>

    <?= $form->field($model->requisicao->veiculo,'disponibilidade_id')
        ->dropDownList($lista,['prompt' => 'Escolha...'])
        ->label('Estado de Disponibilidade') ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary searchbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
