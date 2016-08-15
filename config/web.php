<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    //'name' => 'Уникальное название приложения для пользователя',
    //'language' => 'ru-RU',
    //'layout' => 'main',  шаблон по-умолчанию
    //'layoutPath' => 'layouts', путь к шаблону по-умолчанию в папке layouts

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site',
    'homeUrl' => '/goals/',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'asdasdasdsadqwe23423d3e3e23e',
            /*'baseUrl' => '/goals',*/
        ],
        
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            //'loginUrl' => ['start/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'rules' => [
                'register'  => 'users/create',
                'finished'  => 'goals/finished',
                'add'       => 'goals/add',
                'goals'     => 'goals/index',
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
        'db' => require(__DIR__ . '/db.php'),

    ],
    'params' => $params,
    // Europe/Moscow для России (прим. пер.)
    //'timeZone' => 'America/Los_Angeles',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Index',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        //'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '37.229.8.240']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '37.229.8.240'] // adjust this to your needs
    ];
}

return $config;