    <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use webvimark\modules\UserManagement\components\GhostHtml;

/* @var $this yii\web\View */
/* @var $model app\models\Veiculo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Veículos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Veículo ID - '.$this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="veiculo-view">

    <h1><?= Html::encode('Veículo ID - '.$this->title) ?></h1>

    <p>
        <?= GhostHtml::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary searchbtn']) ?>
        <?= GhostHtml::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id:text:ID do Veículo',
            'matricula:text:Matrícula',
            'modelo.marca.marca:text:Marca',
            'modelo.modelo:text:Modelo',
            'tipoCombustivel.tipo:text:Tipo de Combustível',
            'lugares:text:Lugares',
            'capacidade_bagageira:text:Capacidade de Bagageira',
            'cor:text:Cor',
            'disponibilidade.estado:text:Estado de Disponibilidade do Veículo',
        ],
    ]) ?>

</div>
