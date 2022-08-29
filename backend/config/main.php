<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ]
    ],
    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],


        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'arm.group.utn@gmail.com',
                'password' => 'pmzaxjfrkoaxihbf',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'i18n' => [
            'translations' => [
                'app' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                               'basePath' => '@common/messages',
                               'sourceLanguage' => 'en-US',
                ],
                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                ],              
            ],
        ],
        
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'*',   
            //---> este permite acceso a todas las rutas
            //'index/*',
           'site/login',
           'site/index',
           'site/logout',
           'site/signup',
           'site/request-password-reset',
           'site/reset-password',
           'site/verify-email',
           'site/verification',
            //'site/*',
            //'admin/*',
            //'gii/*',
            //'user/*',
            //'rbac/*',
            //'report/*',
        ]
    ],

    // 'as access' => [
    //     // 'class' => yii2mod\rbac\filters\AccessControl::class,
    //     'class' => 'mdm\admin\components\AccessControl',
    //     'allowActions' => [
    //         'site/login',
    //         'site/logout',
    //         'site/signup',
    //         'site/request-password-reset',
    //         'site/reset-password',
    //         'site/verify-email',
    //         'site/verification',
    //         'site/probando',
    //         // 'admin/*',
    //         // 'rbac/*',
    //         // 'gii/*',
    //         // 'user/*',
    //         // 'reportes/*'
    //         //'some-controller/some-action',
    //         // The actions listed here will be allowed to everyone including guests.
    //         // So, 'admin/*' should not appear here in the production, of course.
    //         // But in the earlier stages of your development, you may probably want to
    //         // add a lot of actions here until you finally completed setting up rbac,
    //         // otherwise you may not even take a first step.
    //     ]
    // ],

    'params' => $params,
];
