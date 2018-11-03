<?php
include $_SERVER['DOCUMENT_ROOT'] . "/config/folders.php";

return [
    'rootDir' => ROOT_DIR,
    'templatesDir' => TEMPLATES_DIR,
    'twigTemplatesDir'  => TWIG_TEMPLATES_DIR,
    'publicThumbDirURL'  => PUBLIC_THUMB_DIR_URL,
    'defaultController' => 'product',
    'controllerNamespace' => 'app\\controllers',
    'repositoriesNamespace' => 'app\\app\\models\\repositories',
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'gb_db',
            'charset' => 'utf8'
            ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ]
    ]
];