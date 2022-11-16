<?php

namespace Tests\Controllers;

use App\Controllers\MainController;
use App\Repository\UserRepository;
use App\Views\View;
use Laminas\Diactoros\Response;
use PHPUnit\Framework\TestCase;

class MainControllerTest extends TestCase
{
    public function testShow()
    {
        $userRepMock = $this->createMock(UserRepository::class);
        $userRepMock->method('selectAll')->willReturn([]);

        $viewMock = $this->createMock(View::class);

        $mainController = new MainController($viewMock, $userRepMock);

        $this->assertInstanceOf(Response::class, $mainController->show());
    }
}
