<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\core\Application;
use app\controllers\AuthController;

$app = new Application(dirname(__DIR__));

$app->router->get( '/', 'home');
$app->router->get( '/users', 'users');

$app->router->get( '/login', [AuthController::class, 'login']);
$app->router->post( '/login', [AuthController::class, 'login']);
$app->router->get( '/register', [AuthController::class, 'register']);
$app->router->post( '/register', [AuthController::class, 'register']);


$app->run();