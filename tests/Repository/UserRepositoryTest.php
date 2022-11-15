<?php

namespace Tests\Repository;

use App\Models\User;
use App\Repository\UserRepository;
use App\Services\Db;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public $dbMock;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(Db::class);
    }

    public function testSelectAll()
    {
        $this->dbMock->method('query')->willReturn([]);

        $userRepository = new UserRepository($this->dbMock);

        $this->assertIsArray($userRepository->selectAll());
    }

    public function testSelectById()
    {
        $this->dbMock->method('query')->willReturn([0 => ['email' => '1', 'name' => '2', 'gender' => '3',
            'id' => '4', 'status' => '5']]);

        $userRepository = new UserRepository($this->dbMock);

        $this->assertInstanceOf(User::class, $userRepository->selectById(['id' => '1']));
    }

    public function testSelectByIdIfNull()
    {
        $this->dbMock->method('query')->willReturn([]);

        $userRepository = new UserRepository($this->dbMock);

        $this->assertNull($userRepository->selectById(['id' => '1']));
    }

    public function testUpdate()
    {
        $userRepository = new UserRepository($this->dbMock);

        $this->dbMock->expects($this->once())->method('query');

        $userRepository->update(1, ['email' => '2', 'name' => '3', 'gender' => '4', 'status' => '5']);
    }

    public function testCreate()
    {
        $userRepository = new UserRepository($this->dbMock);

        $this->dbMock->expects($this->once())->method('query');

        $userRepository->create(['email' => '2', 'name' => '3', 'gender' => '4', 'status' => '5']);
    }

    public function testDelete()
    {
        $userRepository = new UserRepository($this->dbMock);

        $this->dbMock->expects($this->once())->method('query');

        $userRepository->delete(['id' => '1']);
    }
}