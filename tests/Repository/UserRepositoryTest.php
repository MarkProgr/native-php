<?php

namespace Tests\Repository;

use App\Models\User;
use App\Repository\UserRepository;
use App\Services\Db;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public $dbMock;
    public UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(Db::class);
        $this->userRepository = new UserRepository($this->dbMock);
    }

    public function testSelectAll()
    {
        $this->dbMock->method('query')->willReturn([]);

        $this->assertIsArray($this->userRepository->selectAll());
    }

    public function testSelectById()
    {
        $this->dbMock->method('query')->willReturn([0 => ['email' => '1', 'name' => '2', 'gender' => '3',
            'id' => '4', 'status' => '5', 'image_name' => '6']]);

        $this->assertInstanceOf(User::class, $this->userRepository->selectById(['id' => '1']));
    }

    public function testSelectByIdIfNull()
    {
        $this->dbMock->method('query')->willReturn([]);

        $this->assertNull($this->userRepository->selectById(['id' => '1']));
    }

    public function testUpdate()
    {
        $this->dbMock->expects($this->once())->method('query');

        $this->userRepository->update(
            1,
            ['email' => '2', 'name' => '3', 'gender' => '4', 'status' => '5'],
            '6'
        );
    }

    public function testCreate()
    {
        $this->dbMock->expects($this->once())->method('query');

        $this->userRepository->create(
            ['email' => '2', 'name' => '3', 'gender' => '4', 'status' => '5'],
            '6'
        );
    }
}
