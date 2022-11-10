<?php

namespace App\Controllers;

use App\Models\User;
use App\Views\View;
use Laminas\Diactoros\Response;
use App\Services\Db;
use Laminas\Diactoros\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class UserController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }

    public function createForm()
    {
        return new Response\HtmlResponse($this->view->render('create-form'));
    }

    public function showOne(ServerRequest $request, array $params)
    {
        $user = User::selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->view->render('not-found'), 404);
        }

        return new Response\HtmlResponse($this->view->render('show-one', compact('user')));
    }

    public function editForm(ServerRequest $request, array $params)
    {
        $user = User::selectById($params);

        return new Response\HtmlResponse($this->view->render('edit-form', compact('user')));
    }

    public function createUser()
    {
        User::create();

        return new Response\RedirectResponse('/');
    }

    public function editUser(ServerRequest $request, array $params)
    {
        User::update($params);

        return new Response\RedirectResponse('/');
    }

    public function deleteUser(ServerRequest $request, array $params)
    {
        User::delete($params);

        return new Response\RedirectResponse('/');
    }
}