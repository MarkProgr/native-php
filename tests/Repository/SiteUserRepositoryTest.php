<?php

namespace Tests\Repository;

use App\Models\SiteUser;
use App\Repository\SiteUserRepository;
use App\Services\Db;
use PHPUnit\Framework\TestCase;

class SiteUserRepositoryTest extends TestCase
{
    public Db $dbMock;
    public SiteUserRepository $siteUserRepository;

    protected function setUp(): void
    {
        @session_start();
        $this->dbMock = $this->createMock(Db::class);
        $this->siteUserRepository = new SiteUserRepository($this->dbMock);
    }

    public function testLoginIfIncorrectPassword()
    {
        $passwordHash = password_hash('2', PASSWORD_BCRYPT);
        $this->dbMock->method('query')->willReturn(
            ['0' =>
                ['id' => '1',
                    'login' => '1',
                    'password' => $passwordHash,
                    'last_visited' => '3']]
        );

        $this->assertNull($this->siteUserRepository->login(['login' => '1', 'password' => '3']));
    }

    public function testLoginIfEmpty()
    {
        $this->dbMock->method('query')->willReturn([]);

        $this->assertNull($this->siteUserRepository->login(['login' => '', 'password' => '']));
    }

    public function testSignUp()
    {
        $this->dbMock->expects($this->once())->method('query');

        $this->siteUserRepository->signUp(['login' => '1', 'password' => '2']);
    }
}
