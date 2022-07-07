<?php

namespace app\modules\api\v1\controllers;


use app\models\Modelo;

use app\models\Veiculo;
use app\modules\api\v1\components\HttpBasicAuth;
use webvimark\modules\UserManagement\components\GhostAccessControl;
use webvimark\modules\UserManagement\models\User;
use yii\filters\RateLimiter;
use yii\helpers\ArrayHelper;

class VeiculoController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Veiculo';

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

    public function actionVeiculo($id)
    {
        $veiculo = Veiculo::find()->where(['id'=>$id])->one();
        return [
            'id' => $id,
            'matricula' => $veiculo->matricula,
            'cor' => $veiculo->cor,
            'capacidade_bagageira' => $veiculo->capacidade_bagageira,
            'lugares' => $veiculo->lugares,
            'marca' => $veiculo->marca->marca,
            'modelo' => $veiculo->modelo->modelo,
            'tipocombustivel' => $veiculo->tipoCombustivel->tipo,

        ];
    }



    public function actionDisponivel(){

        return [
            $veiculo = Veiculo::find()->Where(['disponibilidade_id'=>1])->all()];


        }





}
