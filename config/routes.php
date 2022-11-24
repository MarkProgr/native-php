<?php

use App\Controllers\SiteUserController;
use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;
use App\Repository\SiteUserRepository;
use App\Repository\UserRepository;
use App\Services\Db;
use League\Route\Router;
use App\Controllers\MainController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

session_start();

$router = new Router();
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$dbSettings = (require __DIR__ . '/settings.php')['db'];
$pdo = new PDO(
    'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
    $dbSettings['user'],
    $dbSettings['password']
);

$twig = new Environment(new FilesystemLoader(__DIR__ . '/../templates'));
$twig->addGlobal('sessionId', $_SESSION);

$mainController = new MainController(
    $twig,
    new UserRepository(
        new Db(
            $pdo
        )
    )
);

$userController = new UserController(
    $twig,
    new UserRepository(
        new Db(
            $pdo
        )
    )
);

$siteUserController = new SiteUserController(
    $twig,
    new SiteUserRepository(
        new Db(
            $pdo
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
$router->get('/sign-up', [$siteUserController, 'signUpForm']);
$router->post('/sign-up', [$siteUserController, 'signUp']);

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
