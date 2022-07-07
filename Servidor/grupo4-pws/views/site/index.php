<?php

/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use yii\helpers\Html;
use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;



$this->title = 'Gestão de Viaturas - Página Inicial';


$css = <<<CSS
html, body {
	background: #eee;
	-webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	height: 100%;
	min-height: 100%;
	position: relative;
}
#login-wrapper {
	position: relative;
	top: 30%;
}
#login-wrapper .registration-block {
	margin-top: 15px;
}
CSS;

$this->registerCss($css);
?>

<div class="container-fluid paginainicialmenu">
    <div class="row menu-row">
        <div class="col-md"></div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/requisicoes.svg',['class' => 'menu-icons']),['/requisicao/index'],['label'=>'requisitar'])?>
                <P><?= GhostHtml::a('Requisições',['/requisicao/index'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/veiculos.svg',['class' => 'menu-icons']),['veiculo/index'],['label'=>'Veículos'])?>
                <P><?= GhostHtml::a('Veículos',['/veiculo/index'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/requisitarVeiculo.svg',['class' => 'menu-icons']),['requisicao/requisitarveiculo'],['label'=>'Requisitar Veículo'])?>
                <P><?= GhostHtml::a('Requisitar Veículo',['/requisicao/requisitarveiculo'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/contas.svg',['class' => 'menu-icons']),['utilizador/index'],['label'=>'Contas'])?>
                <P><?= GhostHtml::a('Contas',['/utilizador/index'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-2 col-md"></div>
    </div>
    <div class="row row-menu">
        <div class="col-md"></div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/manutencoes.svg',['class' => 'menu-icons']),['manutencao/index'],['label'=>'Manutenções'])?>
                <P><?= GhostHtml::a('Manutenções',['/manutencao/index'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/historico.svg',['class' => 'menu-icons']),['/requisicao/reqhistorico'],['label'=>'Manutenções'])?>
                <P><?= GhostHtml::a('Histórico de Requisições',['/requisicao/reqhistorico'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/perfil.svg',['class' => 'menu-icons']),['/utilizador/perfil'],['label'=>'Perfil'])?>
                <P><?= GhostHtml::a('Perfil',['/utilizador/perfil'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md-3 col-menu">
            <div class="imagem">
                <?= GhostHtml::a(GhostHtml::img('../imagens/icons/logout.svg',['class' => 'menu-icons']),['/user-management/auth/logout'],['label'=>'Sair'])?>
                <P><?= GhostHtml::a('Sair',['/user-management/auth/logout'],['class'=>'subtitulo'])?></P>
            </div>
        </div>
        <div class="col-md"></div>
    </div>
</div>
