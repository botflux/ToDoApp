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
$app->get('/', function (Request $request) use ($app) {
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

$app->match('/register', function (Request $request) use ($app) {
    $user = new \Todo\Domain\User();

    $userForm = $app['form.factory']->create(\Todo\Form\Type\UserType::class, $user);

    $userForm->handleRequest($request);

    if ($userForm->isSubmitted()) {
        if ($userForm->isValid()) {
            $passwordGenerator = new \Todo\Generator\PasswordGenerator();
            
            $raw = $user->getPassword();
            $salt = $passwordGenerator->generateRandomSalt();
            $hash = $passwordGenerator->generateHash($raw, $salt);

            $user->setPassword($hash);
            $user->setSalt($salt);
            $user->setRole('ROLE_USER');

            if ($passwordGenerator->isValid($hash, $raw, $salt)) {
                $app['dao.user']->save($user);
            }
        } else {
            var_dump($app['validator']->validate($userForm));
        }
    }

    return $app['twig']->render('register.html.twig', [
        'userForm' => $userForm->createView(),
    ]);
})
->bind('register');

# route vers les options utilisateurs
$app->match('/app/settings', function (Request $request) use ($app) {
    $token = $app['security.token_storage']->getToken();
    $user = null;

    if ($token !== null) {
        $user = $token->getUser();
    }

    $usernameForm = $app['form.factory']->create(\Todo\Form\Type\UsernameType::class, null);
    $passwordForm = $app['form.factory']->create(\Todo\Form\Type\PasswordChangedType::class, null);
    $fullUsernameForm = $app['form.factory']->create(\Todo\Form\Type\CompleteUsernameType::class, $user);

    $usernameForm->handleRequest($request);
    $passwordForm->handleRequest($request);
    $fullUsernameForm->handleRequest($request);

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

    if ($fullUsernameForm->isSubmitted()) {
        if ($fullUsernameForm->isValid()) {
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success_cusername', 'Nom a bien été changé');
        } else {
            foreach($app['validator']->validate($fullUsernameForm) as $err) {
                $app['session']->getFlashBag()->add('fail_cusername', $err->getMessage());
            }
        }
    }

    return $app['twig']->render('settings.html.twig', [
        'usernameForm' => $usernameForm->createView(),
        'passwordForm' => $passwordForm->createView(),
        'fullUsernameForm' => $fullUsernameForm->createView(),
    ]);
})
->bind('settings');

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