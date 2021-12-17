<?php

require_once __DIR__.'/../vendor/autoload.php';
use app\core\Application;

$app = new Application();

$app->router->get( '/', function () {
  return 'Home Pages';
});

$app->router->get( '/users', function () {
  return 'Users Pages';
});

$app->run();