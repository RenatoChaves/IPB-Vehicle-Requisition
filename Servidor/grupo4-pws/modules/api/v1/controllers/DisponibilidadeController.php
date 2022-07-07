<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\components\HttpBasicAuth;
use webvimark\modules\UserManagement\components\GhostAccessControl;
use yii\filters\RateLimiter;
use yii\helpers\ArrayHelper;

class DisponibilidadeController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Disponibilidade';

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
}


