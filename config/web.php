<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
	'id' => 'basic',
	'name' => 'J\'ATTEINS MON BUT',
    	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
    	'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
],

    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' =>[
                        'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                            'js/bootstrap.min.js',
                    ]
                ]
           
            ],
    ],
        'user' => [
            'class' => 'app\models\MyUser', // extend User component
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'h4DWqLUHL42ywvVdvW9Vhprhp4DOpSpj',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\MyUser',
	    'enableAutoLogin' => true,
	    
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
              'class' => 'yii\swiftmailer\Mailer',
              'useFileTransport' => false,
              'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'port' => 587,
                //password and email needed here
                'encryption' => 'tls',
                'streamOptions' => [ 
                    'ssl' => [ 
                        'allow_self_signed' => true, 
                        'verify_peer' => false, 
                        'verify_peer_name' => false, 
                    ], 
                ],
            

              ],
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
