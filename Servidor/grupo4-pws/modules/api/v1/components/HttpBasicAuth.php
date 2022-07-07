<?php

namespace app\modules\api\v1\components;

use webvimark\modules\UserManagement\models\User;


class HttpBasicAuth extends \yii\filters\auth\HttpBasicAuth
{
    public function __construct($config = []) {
        parent::__construct($config);
        $this->auth = function ($username, $password) {
            $user = User::findByUsername($username);
            if (isset($user)) {
                if ($user->validatePassword($password)) {
                    return $user;
                } else {
                    return null;
                }
            }
            return null;
        };
    }
}