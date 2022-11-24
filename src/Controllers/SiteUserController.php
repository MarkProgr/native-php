<?php

namespace App\Controllers;

use App\Repository\SiteUserRepository;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use Twig\Environment;

class SiteUserController
{
    private Environment $twig;
    private SiteUserRepository $siteUser;

    public function __construct(Environment $twig, SiteUserRepository $siteUser)
    {
        $this->twig = $twig;
        $this->siteUser = $siteUser;
    }

    public function authForm(): HtmlResponse
    {
        return new HtmlResponse($this->twig->render('login.php'));
    }

    public function login(ServerRequest $request): Response
    {
        $user = $this->siteUser->login($request->getParsedBody());

        if ($user === null) {
            $error = 'Invalid login or password';

            return new HtmlResponse($this->twig->render('login.php', compact('error')));
        }

        return new RedirectResponse('/');
    }

    public function signUpForm(): HtmlResponse
    {
        return new HtmlResponse($this->twig->render('sign-up.php'));
    }

    public function signUp(ServerRequest $request)
    {
        $data = $request->getParsedBody();

        if ($data['password'] === $data['password_confirmation']) {
            $this->siteUser->signUp($request->getParsedBody());
            return new RedirectResponse('/login');
        } else {
            $error = 'The password and password confirmation fields do not match to each other';
            return new HtmlResponse($this->twig->render('sign-up.php', compact('error')));
        }
    }

    public function logout(): RedirectResponse
    {
        $this->siteUser->logout();

        return new RedirectResponse('/login');
    }
}
