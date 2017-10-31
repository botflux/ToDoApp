<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 00:49
 */

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});