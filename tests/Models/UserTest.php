<?php

namespace Tests\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User(1, 'mark@mark', 'Mark', 'Male', 'Active');
        $this->assertIsInt($user->getId());
    }

    public function testGetEmail()
    {
        $user = new User(1, 'mark@mark', 'Mark', 'Male', 'Active');
        $this->assertIsString($user->getEmail());
    }

    public function testGetName()
    {
        $user = new User(1, 'mark@mark', 'Mark', 'Male', 'Active');
        $this->assertIsString($user->getName());
    }

    public function testGetGender()
    {
        $user = new User(1, 'mark@mark', 'Mark', 'Male', 'Active');
        $this->assertIsString($user->getGender());
    }

    public function testGetStatus()
    {
        $user = new User(1, 'mark@mark', 'Mark', 'Male', 'Active');
        $this->assertIsString($user->getStatus());
    }
}
