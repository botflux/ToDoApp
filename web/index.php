<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 00:40
 */

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__.'/../app/app.php';
require_once __DIR__.'/../app/config/prod.php';
require_once __DIR__.'/../app/routes.php';

$app->run();