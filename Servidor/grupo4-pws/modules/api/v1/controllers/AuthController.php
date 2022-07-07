<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\components\HttpBasicAuth;
use webvimark\modules\UserManagement\components\GhostAccessControl;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;
use yii;

/**
 * This controller can only be requested by active users with the right permissions using HTTP Basic authentication
 * using username:password only!
 * @author evandro
 *
 */
class AuthController extends \yii\rest\Controller {
    public $defaultAction = 'auth-key';

    /**
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
        ]);
    }

    const PERMISSION_AUTH_KEY = 'permission_ApiV1_Auth_AuthKey';
    /**
     * This action only return the authentication key for the current user
     * @return string[]
     */

    public function actionAuthKey()
    {
        return ['accessToken' => User::getCurrentUser()->auth_key,
            User::getCurrentUser()];
    }

    public function actionRoles() {
        return User::getCurrentUser()->roles;

    }


}

