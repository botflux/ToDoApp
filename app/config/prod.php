<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 31/10/2017
 * Time: 00:49
 */

$app['db.options'] = [
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'todoapp',
    'user'     => 'todoapp_user',
    'password' => 'secret',
];

require_once __DIR__.'/dev.php';

