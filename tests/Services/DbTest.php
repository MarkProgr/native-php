<?php

namespace Tests\Services;

use App\Models\User;
use App\Services\Db;
use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    public function testQuery()
    {
        $pdoMock = $this->createMock(\PDO::class);
        $prepareMock = $this->createMock(\PDOStatement::class);
        $prepareMock->method('execute')->willReturn(true);
        $prepareMock->method('fetchAll')->willReturn([]);

        $db = new Db($pdoMock);

        $pdoMock->method('prepare')->willReturn($prepareMock);

        $sql = 'SELECT * FROM users;';
        $this->assertIsArray($db->query($sql, [], User::class));
    }
}
