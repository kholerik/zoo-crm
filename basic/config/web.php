<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'language' => 'ru-RU',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'dtConverter' => [
            'class' => 'bupy7\datetime\converter\Converter',
            // 'saveTimeZone' => 'UTC' - by default
            // 'saveDate' => 'php:Y-m-d' - by default
            // 'saveTime' => 'php:H:i:s' - by default
            // 'saveDateTime' => 'php:U' - by default
            // add format patterns if need for your locales (by default uses `en`)
            'patterns' => [
                'ru-RU' => [
                    'displayTimeZone' => 'Europe/Moscow',
                    'displayDate' => 'php:d.F.Y',
                    'displayTime' => 'php:H:i',
                    'displayDateTime' => 'php:d.F.Y, H:i',
                ],
            ],
        ],      
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4Kedxyrt_5SGo2h1yFJwFklAhj9Z5APe',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'date' => [
            'class' => 'app\components\Date',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
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
