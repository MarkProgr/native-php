<?php

use App\Controllers\UserController;
use App\Repository\UserRepository;
use App\Services\Db;
use App\Views\View;
use League\Route\Router;
use App\Controllers\MainController;

$router = new Router;
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$dbSettings = (require __DIR__ . '/settings.php')['db'];

$mainController = new MainController(new View(__DIR__ . '/../templates'),
    new UserRepository(
        new Db(
            new PDO('mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password'])
        )
    ));

$userController = new UserController(new View(__DIR__ . '/../templates'),
    new UserRepository(
        new Db(
            new PDO('mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password'])
        )
    ));


$router->get('/', [$mainController, 'show']);
$router->get('/create', [$userController, 'createForm']);
$router->get('/{id:number}', [$userController, 'showOne']);
$router->get('/{id:number}/edit', [$userController, 'editForm']);
$router->post('/create', [$userController, 'createUser']);
$router->post('/{id:number}/edit', [$userController, 'editUser']);
$router->post('/{id:number}/delete', [$userController, 'deleteUser']);

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);