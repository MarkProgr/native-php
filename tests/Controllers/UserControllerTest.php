<?php

namespace Tests\Controllers;

use App\Controllers\UserController;
use App\Models\User;
use App\Repository\UserRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\UploadedFile;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class UserControllerTest extends TestCase
{
    public $userRepMock;
    public $twigMock;
    public UserController $userController;

    protected function setUp(): void
    {
        $this->userRepMock = $this->createMock(UserRepository::class);
        $this->twigMock = $this->createMock(Environment::class);
        $this->userController = new UserController($this->twigMock, $this->userRepMock);
    }

    public function testCreateForm()
    {
        $this->assertInstanceOf(HtmlResponse::class, $this->userController->createForm());
    }

    public function testShowOne()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);
        $userMock = $this->createMock(User::class);

        $this->userRepMock->method('selectById')->willReturn($userMock);

        $this->assertInstanceOf(HtmlResponse::class, $this->userController->showOne($serverRequestMock, [1]));
    }

    public function testCreateUser()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);

        $uploadedMock = $this->createMock(UploadedFile::class);

        $serverRequestMock->method('getUploadedFiles')->willReturn(['image' => $uploadedMock]);
        $serverRequestMock->method('getParsedBody')->willReturn(
            ['email' => '1',
                'name' => '2',
                'gender' => '3',
                'status' => '4']
        );

        $this->userRepMock->expects($this->once())->method('create');

        $this->assertInstanceOf(RedirectResponse::class, $this->userController->createUser($serverRequestMock));
    }

    public function testEditUser()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);

        $uploadedMock = $this->createMock(UploadedFile::class);

        $serverRequestMock->method('getUploadedFiles')->willReturn(['image' => $uploadedMock]);

        $serverRequestMock->method('getParsedBody')->willReturn(
            ['email' => '1',
                'name' => '2',
                'gender' => '3',
                'status' => '4']
        );

        $this->userRepMock->expects($this->once())->method('update');

        $this->assertInstanceOf(RedirectResponse::class, $this->userController->editUser(
            $serverRequestMock,
            ['id' => '1', 'email' => '2', 'name' => '3', 'gender' => '4', 'status' => '5', 'image_name' => '6']
        ));
    }

    public function testDeleteUser()
    {
        $serverReqMock = $this->createMock(ServerRequest::class);

        $this->userRepMock->expects($this->once())->method('delete');

        $this->assertInstanceOf(RedirectResponse::class, $this->userController->deleteUser($serverReqMock, ['1']));
    }

    public function testGenerateImageName()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);

        $uploadedMock = $this->createMock(UploadedFile::class);

        $uploadedMock->method('getClientFilename')->willReturn('1');

        $serverRequestMock->method('getUploadedFiles')->willReturn(['image' => $uploadedMock]);

        $this->assertIsString($this->userController->generateImageName($serverRequestMock));
    }

    public function testGenerateImageNameIfNull()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);

        $uploadedMock = $this->createMock(UploadedFile::class);

        $uploadedMock->method('getClientFilename')->willReturn('');

        $serverRequestMock->method('getUploadedFiles')->willReturn(['image' => $uploadedMock]);

        $this->assertNull($this->userController->generateImageName($serverRequestMock));
    }
}
