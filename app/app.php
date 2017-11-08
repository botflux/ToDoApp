<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 00:49
 */

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../views',
]);
$app->register(new Silex\Provider\AssetServiceProvider(), [
    'assets.version' => 'v1',
    'assets.named_packages' => [
        'css' => [
            'base_path' => '/css',
        ],
        'images' => [
            'base_path' => '/lib/ionicons/src',
        ],
        'bootstrap' => [
            'base_path' => '/lib/bootstrap',
        ],
    ],
]);
$app->register(new \Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => __DIR__.'/../development.log',
]);
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), [
    'translator.domains' => [],
]);
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\CsrfServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), [
    'security.firewalls' => [
        'secured' => [
            'pattern' => '^/',
            'anonymous' => true,
            'form' => [
                'login_path' => '/login',
                'check_path' => '/login_check',
            ],
            'logout' => [
                'logout_path' => '/logout',
                'invalidate_session' => true,
            ],
            'users' => function () use ($app) {
                return new \Todo\DAO\UserDAO($app['db']);
            },
        ],
    ],
    'security.role_hierarchy' => [
        'ROLE_ADMIN' => [
            'ROLE_USER'
        ],
    ],
    'security.access_rules' => [
        [
            '^/admin',
            'ROLE_ADMIN'
        ],
        [
            '^/app',
            'ROLE_USER',
        ],
    ],
]);

$app['dao.user'] = function () use ($app) {
    return new \Todo\DAO\UserDAO($app['db']);
};