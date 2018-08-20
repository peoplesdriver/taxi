<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', CarController::class . ':showAdminCars')->setName('home')->add(new IsLogin($container));

$app->get('/login', UserController::class.':showLoginForm')->setName('user.showLoginForm');
$app->get('/logout', UserController::class.':logout')->setName('user.logout');

$app->get('/good', TestController::class.':good')->add(new IsLogin($container));