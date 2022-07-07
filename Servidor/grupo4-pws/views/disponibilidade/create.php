<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Disponibilidade */

$this->title = 'Create Disponibilidade';
$this->params['breadcrumbs'][] = ['label' => 'Disponibilidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disponibilidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
