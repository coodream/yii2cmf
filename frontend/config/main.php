<?php

$params = array_merge(
    require(__DIR__.'/../../common/config/params.php'),
    require(__DIR__.'/../../common/config/params-local.php'),
    require(__DIR__.'/params.php'),
    require(__DIR__.'/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'on afterLogin' => function($event) {
                $event->identity->touch('login_at');
            }
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'forceTranslation' => true,
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '<id:\d+>',
                    'route' => 'article/view',
                    'suffix' => '.html'
                ],
                'user/<id:\d+>' => '/user',
                'tag/<name:\S+>' => '/article/tag'
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'qq' => [
                    'class' => 'frontend\components\authclient\clients\QqOAuth',
                    'clientId' => env('QQ_CLIENT_ID'),
                    'clientSecret' => env('QQ_CLIENT_SECRET')
              ],
                // etc.
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@frontend/components/bootstrap/dist'
                ],
            ],
        ],
        'view' => [
            'on beginPage' => function($event){
                if ($event->sender->title) {
                    $event->sender->title .= '_' . \Yii::$app->config->get('SITE_NAME');
                } else {
                    $event->sender->title = \Yii::$app->config->get('SITE_NAME');
                }
            }
        ],
        'message' => \frontend\components\Message::className()
    ],
    'as ThemeBehavior' => \frontend\behaviors\ThemeBehavior::className(),
    'as RouteBehavior' => \frontend\behaviors\RouteBehavior::className(),
    'params' => $params,
];
