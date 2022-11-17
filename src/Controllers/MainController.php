<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use Laminas\Diactoros\Response;
use App\Views\View;

class MainController
{
    private View $view;
    private UserRepository $user;

    public function __construct(View $view, UserRepository $user)
    {
        $this->view = $view;
        $this->user = $user;
    }

    public function show(): Response
    {
        $users = $this->user->selectAll();

        if (!$_COOKIE) {
            return new Response\RedirectResponse('/login');
        }

        return new Response\HtmlResponse($this->view->render('main', compact('users')));
    }
}
