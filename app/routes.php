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
    $userArticles = $app['dao.article']->findByUser($app['security.token_storage']->getToken()->getUser());
    $articles = $app['dao.article']->findAll();

    return $app['twig']->render('index.html.twig', [
        'userArticles' => $userArticles,
        'allArticles' => $articles,
    ]);
})
->bind('home');

$app->match('/login', function (Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', [
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ]);
})
->bind('login');

# route vers les options utilisateurs
$app->match('/settings', function (Request $request) use ($app) {
    $token = $app['security.token_storage']->getToken();
    $user = null;

    if ($token !== null) {
        $user = $token->getUser();
    }

    $usernameForm = $app['form.factory']->create(\Todo\Form\Type\UsernameType::class, null);
    $passwordForm = $app['form.factory']->create(\Todo\Form\Type\PasswordChangedType::class, null);

    $usernameForm->handleRequest($request);
    $passwordForm->handleRequest($request);

    if ($usernameForm->isSubmitted()) {
        if ($usernameForm->isValid()) {
            $newUsername = $request->get('username')['username'];

            if (!$app['dao.user']->usernameAlreadyTaken($newUsername)) {
                $user->setUsername($newUsername);
                $app['dao.user']->save($user);
                $app['session']->getFlashBag()->add('success_username', 'Nom d\'utilisateur changé');
            } else {
                $app['session']->getFlashBag()->add('fail_username', 'Nom d\'utilisateur déjà utilisé');
            }
        } else {
            foreach ($app['validator']->validate($usernameForm) as $err) {
                $app['session']->getFlashBag()->add('fail_username', $err->getMessage());
            }
        }
    }

    if ($passwordForm->isSubmitted()) {
        if ($passwordForm->isValid()) {
            $encoder = new \Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder(13);
            $passwordData =  $request->get('password_changed');
            $raw = $passwordData['last_password'];
            $newRaw = $passwordData['password']['first'];

            // si c'est bien le mot de passe actuel
            if ($encoder->isPasswordValid($user->getPassword(), $raw, $user->getSalt())) {
                $randomBinaryString = random_bytes(23);
                $salt = password_hash($randomBinaryString, \PASSWORD_BCRYPT);
                $salt = substr($salt,0,23);
                $encoder = new \Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder(13);
                $hash = $encoder->encodePassword($newRaw, $salt);

                if ($encoder->isPasswordValid($hash, $newRaw, $salt)) {
                    $user->setPassword($hash);
                    $user->setSalt($salt);
                    $app['dao.user']->save($user);
                    $app['session']->getFlashBag()->add('success_password', 'Mot de passe changé');
                } else {
                    $app['session']->getFlashBag()->add('fail_password', 'Une erreur est survenue');
                }

            } else {
                $app['session']->getFlashBag()->add('fail_password', 'Le mot de passe n\'est pas correcte');
            }
        } else {
            // alert-danger un champs n'est pas valide
            foreach ($app['validator']->validate($passwordForm) as $err) {
                $app['session']->getFlashBag()->add('fail_password', $err->getMessage());
            }
        }
    }

    return $app['twig']->render('settings.html.twig', [
        'usernameForm' => $usernameForm->createView(),
        'passwordForm' => $passwordForm->createView(),
    ]);
})
->bind('settings');

$app->get('/articles', function (Request $request) use ($app) {
    
    $filter = $request->get('articles');

    // met par defaut a all 
    $filter = ($filter === null)? 'all': $filter;

    if ($filter === 'my') {
        $articles = $app['dao.article']->findByUser($app['security.token_storage']->getToken()->getUser());
        
    } else {
        $articles = $app['dao.article']->findAll();
    }
    return $app['twig']->render('articles.html.twig', [
        'articles' => $articles,
        'filter' => $filter,
    ]);

})
->bind('articles');

# génère un mot de passe
$app->get('/mtp/{m}', function ($m) use ($app) {

    $randomBinaryString = random_bytes(23);
    $salt = password_hash($randomBinaryString, \PASSWORD_BCRYPT);
    $salt = substr($salt,0,23);
    var_dump($salt);

    $encoder = new \Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder(13);
    $hash = $encoder->encodePassword($m, $salt);
    var_dump($hash);
    var_dump($encoder->isPasswordValid($hash, $m, $salt));

    return '';
});