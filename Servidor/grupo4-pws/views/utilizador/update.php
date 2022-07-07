<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Utilizador */

$this->title = 'Editar Conta de Utilizador ID - ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contas de Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>'Conta de Utilizador ID - '.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="utilizador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
