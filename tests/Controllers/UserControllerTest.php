<?php

namespace Tests\Controllers;

use App\Controllers\UserController;
use App\Models\User;
use App\Repository\UserRepository;
use App\Views\View;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public $userRepMock;
    public $viewMock;

    protected function setUp(): void
    {
        $this->userRepMock = $this->createMock(UserRepository::class);
        $this->viewMock = $this->createMock(View::class);
    }

    public function testCreateForm()
    {
        $userController = new UserController($this->viewMock, $this->userRepMock);
        $this->assertInstanceOf(HtmlResponse::class, $userController->createForm());
    }

    public function testShowOne()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);
        $userMock = $this->createMock(User::class);

        $this->userRepMock->method('selectById')->willReturn($userMock);

        $userController = new UserController($this->viewMock, $this->userRepMock);

        $this->assertInstanceOf(HtmlResponse::class, $userController->showOne($serverRequestMock, [1]));
    }

    public function testCreateUser()
    {
        $this->userRepMock->expects($this->once())->method('create');

        $userController = new UserController($this->viewMock, $this->userRepMock);

        $this->assertInstanceOf(RedirectResponse::class, $userController->createUser());
    }

    public function testEditUser()
    {
        $serverReqMock = $this->createMock(ServerRequest::class);

        $this->userRepMock->expects($this->once())->method('update');

        $userController = new UserController($this->viewMock, $this->userRepMock);

        $this->assertInstanceOf(RedirectResponse::class, $userController->editUser($serverReqMock,
            ['id' => '1', 'email' => '2', 'name' => '3', 'gender' => '4', 'status' => '5']));
    }

    public function testDeleteUser()
    {
        $serverReqMock = $this->createMock(ServerRequest::class);

        $this->userRepMock->expects($this->once())->method('delete');

        $userController = new UserController($this->viewMock, $this->userRepMock);

        $this->assertInstanceOf(RedirectResponse::class, $userController->deleteUser($serverReqMock, ['1']));
    }
}