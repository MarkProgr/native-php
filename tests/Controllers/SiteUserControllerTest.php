<?php

namespace Tests\Controllers;

use App\Controllers\SiteUserController;
use App\Repository\SiteUserRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class SiteUserControllerTest extends TestCase
{
    public SiteUserController $siteUserController;
    public Environment $twigMock;
    public SiteUserRepository $siteUserMock;

    protected function setUp(): void
    {
        $this->twigMock = $this->createMock(Environment::class);
        $this->siteUserMock = $this->createMock(SiteUserRepository::class);
        $this->siteUserController = new SiteUserController($this->twigMock, $this->siteUserMock);
    }

    public function testAuthForm()
    {
        $this->assertInstanceOf(HtmlResponse::class, $this->siteUserController->authForm());
    }

    public function testLogin()
    {
        $this->siteUserMock->method('login')->willReturn(true);

        $serverRequestMock = $this->createMock(ServerRequest::class);
        $serverRequestMock->method('getParsedBody')->willReturn(['login' => '1', 'password' => '2']);

        $this->assertInstanceOf(RedirectResponse::class, $this->siteUserController->login($serverRequestMock));
    }

    public function testLoginIfNull()
    {
        $this->siteUserMock->method('login')->willReturn(null);

        $serverRequestMock = $this->createMock(ServerRequest::class);
        $serverRequestMock->method('getParsedBody')->willReturn(['login' => '', 'password' => '']);

        $this->assertInstanceOf(HtmlResponse::class, $this->siteUserController->login($serverRequestMock));
    }

    public function testSignUpForm()
    {
        $this->assertInstanceOf(HtmlResponse::class, $this->siteUserController->signUpForm());
    }

    public function testSignUp()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);
        $serverRequestMock->method('getParsedBody')->willReturn(
            ['login' => '1',
            'password' => '2',
            'password_confirmation' => '2']
        );

        $this->assertInstanceOf(RedirectResponse::class, $this->siteUserController->signUp($serverRequestMock));
    }

    public function testSignUpIfPasswordIncorrect()
    {
        $serverRequestMock = $this->createMock(ServerRequest::class);
        $serverRequestMock->method('getParsedBody')->willReturn(
            ['login' => '1',
                'password' => '2',
                'password_confirmation' => '4']
        );

        $this->assertInstanceOf(HtmlResponse::class, $this->siteUserController->signUp($serverRequestMock));
    }

    public function testLogout()
    {
        $this->assertInstanceOf(RedirectResponse::class, $this->siteUserController->logout());
    }
}
