<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'f7K_U3JO1m2UWjoICyh5nGVwzqzCJOU3',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
            'identityClass' => 'app\models\User',
            // Comment this if you don't want to record user logins
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);

                $user = \app\models\Utilizador::find()->where(['user_id' => \webvimark\modules\UserManagement\models\User::getCurrentUser()->id])->one();
                if (!isset($user)) {
                    Yii::$app->response->redirect(['/utilizador/create'])->send();
                    return;
                }


            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport'=>[
                'class'=>'Swift_SmtpTransport',
                'host'=>'smtp.gmail.com',
                'username'=> 'gestaodeviaturas@gmail.com',
                'password'=> 'gestaodeviaturas123',
                'port' => '587',
                'encryption'=> 'tls'
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/disponibilidade'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/manutencao'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/marca'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/modelo'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/requisicao'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/tipocombustivel'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/unidadeorganica'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/utilizador'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/validacao'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/veiculo'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-v1/user'],
            ],
        ],

    ],
    'modules'=>[
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',


           'enableRegistration' => true,
            'useEmailAsLogin' => true,
            'emailConfirmationRequired' =>false,
//            'loginUrl' => ['../site/index'],

            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string

            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',


            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( $event->action->uniqueId == 'views/site/index' )
                {
                    $event->action->controller->layout = 'loginLayout.php';
                };
            },
        ],
        'api-v1' => [
            'class' => 'app\modules\api\v1\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
