<?php

namespace App\Controllers;

use App\Models\User;
use App\Repository\UserRepository;
use App\Views\View;
use Laminas\Diactoros\Response;
use App\Services\Db;
use Laminas\Diactoros\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class UserController
{
    private View $view;
    private UserRepository $user;

    public function __construct(View $view, UserRepository $user)
    {
        $this->view = $view;
        $this->user = $user;
    }

    public function createForm(): Response\HtmlResponse
    {
        return new Response\HtmlResponse($this->view->render('create-form'));
    }

    public function showOne(ServerRequest $request, array $params): Response\HtmlResponse
    {
        $user = $this->user->selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->view->render('not-found'), 404);
        }

        return new Response\HtmlResponse($this->view->render('show-one', compact('user')));
    }

    public function editForm(ServerRequest $request, array $params): Response\HtmlResponse
    {
        $user = $this->user->selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->view->render('not-found'), 404);
        }

        return new Response\HtmlResponse($this->view->render('edit-form', compact('user')));
    }

    public function createUser(): Response\RedirectResponse
    {
        $this->user->create($_POST);
//        var_dump($this->user);

        return new Response\RedirectResponse('/');
    }

    public function editUser(ServerRequest $request, array $params): Response\RedirectResponse
    {
        $this->user->update($params['id'], $_POST);

        return new Response\RedirectResponse('/');
    }

    public function deleteUser(ServerRequest $request, array $params): Response\RedirectResponse
    {
        $this->user->delete($params);

        return new Response\RedirectResponse('/');
    }
}