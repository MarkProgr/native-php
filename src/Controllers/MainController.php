<?php

namespace App\Controllers;

use App\Models\User;
use Laminas\Diactoros\Response;
use App\Services\Db;
use App\Views\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }

    public function show()
    {
        $users = User::selectAll();

        return new Response\HtmlResponse($this->view->render('main', compact('users')));
    }
}