<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;

$baseUrl = str_replace('/backend/web', '/admin', (new Request)->getBaseUrl());

return [
    'id' => 'app-backend',
    'name' => 'My Gym',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'Agongym',
                'password' => 'Daniel1234',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => Yii::getAlias('@frontend') . '/web/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'presenca/adicionar-presenca/<idRegisto:\d+>' => 'presenca/adicionar-presenca',
                'presenca/adicionar-presenca-aula/<idRegisto:\d+>' => 'presenca/adicionar-presenca-aula',
                'cliente/marcar-presenca/<id:\d+>' => 'cliente/marcar-presenca',
                'inscricao/musculacao/<ri:\w+>/<user:\d+>' => 'inscricao/musculacao',
                'categoria/create' => 'categoriaproduto/create',
                'categoria/index' => 'categoriaproduto/index',
                'categoria/atualizar/<id:\d+>' => 'categoriaproduto/update',
                'categoria/<id:\d+>' => 'categoriaproduto/view',
                'categoria/apagar/<id:\d+>' => 'categoriaproduto/delete',
                'subcategoria/create' => 'subcategoriaproduto/create',
                'subcategoria/index' => 'subcategoriaproduto/index',
                'subcategoria/<id:\d+>' => 'subcategoriaproduto/view',
                'subcategoria/apagar/<id:\d+>' => 'subcategoriaproduto/delete',
                'subcategoria/atualizar/<id:\d+>' => 'subcategoriaproduto/update',
                'produto/listar/<page:\d+>' => 'produto/listar',
                'produto/listar/sub/<sub:\d+>' => 'produto/listar',
                'planoexercicio/lista/<id:\d+>' => 'planoexercicio/lista',
                'planonutricao/lista/<id:\d+>' => 'planonutricao/lista',
                'planoexercicio/mostrar-imagem/<id:\d+>' => 'planoexercicio/mostrar-imagem',
                'planoexercicio/criar-pdf/<id:\d+>' => 'planoexercicio/criar-pdf',
            ],
        ],
    ],
    'params' => $params,
];
