<?php

namespace Tests\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public User $user;

    protected function setUp(): void
    {
        $this->user = new User(1, 'mark@mark', 'Mark', 'Male', 'Active', '2');
    }

    public function testGetId()
    {
        $this->assertIsInt($this->user->getId());
    }

    public function testGetEmail()
    {
        $this->assertIsString($this->user->getEmail());
    }

    public function testGetName()
    {
        $this->assertIsString($this->user->getName());
    }

    public function testGetGender()
    {
        $this->assertIsString($this->user->getGender());
    }

    public function testGetStatus()
    {
        $this->assertIsString($this->user->getStatus());
    }
}
