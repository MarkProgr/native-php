<?php

use App\Controllers\SiteUserController;
use App\Controllers\UserController;
use App\Controllers\UserSiteController;
use App\Middlewares\AuthMiddleware;
use App\Repository\SiteUserRepository;
use App\Repository\UserRepository;
use App\Services\Db;
use App\Views\View;
use League\Route\Router;
use App\Controllers\MainController;

$router = new Router();
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$dbSettings = (require __DIR__ . '/settings.php')['db'];

$mainController = new MainController(
    new View(__DIR__ . '/../templates'),
    new UserRepository(
        new Db(
            new PDO(
                'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password']
            )
        )
    )
);

$userController = new UserController(
    new View(__DIR__ . '/../templates'),
    new UserRepository(
        new Db(
            new PDO(
                'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password']
            )
        )
    )
);

$siteUserController = new SiteUserController(
    new View(__DIR__ . '/../templates'),
    new SiteUserRepository(
        new Db(
            new PDO(
                'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password']
            )
        )
    )
);


$router->get('/', [$mainController, 'show'])->middleware(new AuthMiddleware());
$router->get('/create', [$userController, 'createForm'])->middleware(new AuthMiddleware());
$router->get('/{id:number}', [$userController, 'showOne'])->middleware(new AuthMiddleware());
$router->get('/{id:number}/edit', [$userController, 'editForm'])->middleware(new AuthMiddleware());
$router->post('/create', [$userController, 'createUser'])->middleware(new AuthMiddleware());
$router->post('/{id:number}/edit', [$userController, 'editUser'])->middleware(new AuthMiddleware());
$router->post('/{id:number}/delete', [$userController, 'deleteUser'])->middleware(new AuthMiddleware());
$router->get('/login', [$siteUserController, 'authForm']);
$router->post('/login', [$siteUserController, 'login']);
$router->post('/logout', [$siteUserController, 'logout'])->middleware(new AuthMiddleware());

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
