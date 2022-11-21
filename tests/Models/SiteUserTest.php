<?php

namespace Tests\Models;

use App\Models\SiteUser;
use PHPUnit\Framework\TestCase;

class SiteUserTest extends TestCase
{
    public SiteUser $siteUser;

    protected function setUp(): void
    {
        $this->siteUser = new SiteUser('1', '2', '4', '6');
    }

    public function testGetId()
    {
        $this->assertIsInt($this->siteUser->getId());
    }

    public function testGetLogin()
    {
        $this->assertIsString($this->siteUser->getLogin());
    }

    public function testGetPassword()
    {
        $this->assertIsString($this->siteUser->getPassword());
    }

    public function testGetLastVisited()
    {
        $this->assertIsString($this->siteUser->getLastVisited());
    }
}
