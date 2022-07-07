<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use webvimark\modules\UserManagement\UserManagementModule;
use webvimark\modules\UserManagement\components\GhostNav;
use kartik\icons\Icon;

Icon::map($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-fluid">
    <div class="row coluna_dropdown jumbomain">
            <div class="jumbotron-fluid jumbo-edit" style="margin-bottom: 0px">
                <h1 class="titulosite">Instituto Politécnico de Bragança</h1>
                <p>Requisição de Viaturas</p>
            </div>
    </div>
</div>

<div class="wrap">
    <?php
    NavBar::begin([

        'brandLabel' => Html::a(Html::img('../imagens/icons/logo_gv.png',['class'=>'logoprincipal']),['/site/index']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo GhostNav::widget([
        'options' => ['class' => 'navbar-nav navbar-right color-me'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Página Inicial', 'url' => ['/site/index']],
            ['label' => 'Requisições', 'url' => ['/requisicao/index']],
            ['label' => 'Requisitar Veículo', 'url' => ['/requisicao/requisitarveiculo']],
            ['label' => 'Veículos', 'url' => ['/veiculo/index']],
            ['label' => 'Histórico', 'url' => ['/requisicao/reqhistorico']],
            ['label' => 'Manutenções', 'url' => ['/manutencao/index']],
            ['label' => 'Contas', 'url' => ['/utilizador/index']],
            ['label' => 'Admin', 'items' => UserManagementModule::menuItems()],

            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user-management/auth/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user-management/auth/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
