<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UnidadeOrganica;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Utilizador */
/* @var $form yii\widgets\ActiveForm */


$unidadeOrganica = UnidadeOrganica::find()->all();

$lista = ArrayHelper::map($unidadeOrganica, 'id', 'unidadeOrganica');




?>

<div class="utilizador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')
        ->textInput(['maxlength' => true])
        ->label('Nome') ?>

    <?= $form->field($model, 'apelido')
        ->textInput(['maxlength' => true])
        ->label('Apelido') ?>

    <?= $form->field($model, 'numeroBI')
        ->textInput(['maxlength' => true])
        ->label('Número de Identificação') ?>

    <?= $form->field($model, 'numeroMecanografico')
        ->textInput(['maxlength' => true])
        ->label('Número Mecanográfico') ?>

    <?= $form->field($model, 'telemovel')
        ->textInput(['maxlength' => true])
        ->label('Telemóvel') ?>


    <?= $form->field($model, 'unidadeOrganica_id')
        ->dropDownList($lista, ['prompt' => 'Escolha...'])
        ->label('Unidade Orgânica') ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary searchbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
