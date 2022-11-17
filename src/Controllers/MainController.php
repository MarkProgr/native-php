<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use Laminas\Diactoros\Response;
use Twig\Environment;

class MainController
{
    private Environment $twig;
    private UserRepository $user;

    public function __construct(Environment $twig, UserRepository $user)
    {
        $this->twig = $twig;
        $this->user = $user;
    }

    public function show(): Response
    {
        $users = $this->user->selectAll();

        return new Response\HtmlResponse($this->twig->render('main.php', compact('users')));
    }
}
