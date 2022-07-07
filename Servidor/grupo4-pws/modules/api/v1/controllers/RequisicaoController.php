<?php

namespace app\modules\api\v1\controllers;

use app\models\Utilizador;
use app\modules\api\v1\components\HttpBasicAuth;
use webvimark\modules\UserManagement\components\GhostAccessControl;
use webvimark\modules\UserManagement\models\User;
use yii\filters\RateLimiter;
use yii\helpers\ArrayHelper;
use app\models\Requisicao;

class RequisicaoController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Requisicao';

    /**
     *
     * {@inheritDoc}
     * @see \yii\rest\Controller::behaviors()
     */
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
            'ghost-access'=> [
                'class' => GhostAccessControl::class,
            ],
            'authenticator' => [
                'class' => HttpBasicAuth::class,
            ],
            'rateLimiter' => [
                'class' => RateLimiter::class,
            ]
        ]);
    }
    public function actionReqid(){

        $user = User::getCurrentUser()->id;
        $utilizador = Utilizador::find()->Where(['user_id'=>$user])->one();
        return [

            $userAtual = Requisicao::find()->Where(['utilizador_id'=>$utilizador])->all()];


    }

    public function actionVeiculo(){


    }

}