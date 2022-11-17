<?php

namespace App\Controllers;

use App\Repository\SiteUserRepository;
use App\Views\View;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;

class SiteUserController
{
    private View $view;
    private SiteUserRepository $siteUser;

    public function __construct(View $view, SiteUserRepository $siteUser)
    {
        $this->view = $view;
        $this->siteUser = $siteUser;
    }

    public function authForm(): HtmlResponse
    {
        return new HtmlResponse($this->view->render('login'));
    }

    public function login(ServerRequest $request): Response
    {
        $user = $this->siteUser->login($request->getParsedBody());

        if ($user === null) {
            $error = 'Invalid login or password';

            return new HtmlResponse($this->view->render('login', compact('error')));
        }

        return new RedirectResponse('/');
    }

    public function logout(): RedirectResponse
    {
        $this->siteUser->logout();

        return new RedirectResponse('/login');
    }
}
