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

    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
        return $app->redirect('/');
    }

    return $app['twig']->render('login.html.twig', [
        'error' => $app['security.last_error']($request),
    ]);
})
->bind('login');

$app->match('/register', function(Request $request) use ($app){
    return $app['twig']->render('user_form.html.twig');
})
->bind('user_register');
