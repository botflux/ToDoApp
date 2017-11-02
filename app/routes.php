<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 00:49
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

# Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})
->bind('home');

$app->match('/login', function (Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', [
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ]);
})
->bind('login');

$app->match('/settings/{id}', function (Request $request, $id) use ($app) {
    return $app->redirect('/');
})
->bind('settings');