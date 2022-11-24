<?php

namespace Tests\Controllers;

use App\Controllers\MainController;
use App\Repository\UserRepository;
use App\Views\View;
use Laminas\Diactoros\Response;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class MainControllerTest extends TestCase
{
    public function testShow()
    {
        $userRepMock = $this->createMock(UserRepository::class);
        $userRepMock->method('selectAll')->willReturn([]);

        $twigMock = $this->createMock(Environment::class);

        $mainController = new MainController($twigMock, $userRepMock);

        $this->assertInstanceOf(Response::class, $mainController->show());
    }
}
