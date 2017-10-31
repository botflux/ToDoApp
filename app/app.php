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