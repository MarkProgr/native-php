<?php

use App\Controllers\UserController;
use League\Route\Router;
use App\Controllers\MainController;

$router = new Router;
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$mainController = new MainController();
$userController = new UserController();

$router->get('/', [$mainController, 'show']);
$router->get('/create', [$userController, 'createForm']);
$router->get('/{id:number}', [$userController, 'showOne']);
$router->get('/{id:number}/edit', [$userController, 'editForm']);
$router->post('/create', [$userController, 'createUser']);
$router->post('/{id:number}/edit', [$userController, 'editUser']);
$router->post('/{id:number}/delete', [$userController, 'deleteUser']);

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);