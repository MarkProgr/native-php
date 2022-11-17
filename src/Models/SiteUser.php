<?php

namespace App\Models;

use DateTime;

class SiteUser
{
    private int $id;
    private string $login;
    private int $password;
    private string $lastVisited;

    public function __construct(
        int $id,
        string $login,
        int $password,
        string $lastVisited
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->lastVisited = $lastVisited;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): int
    {
        return $this->password;
    }

    public function getLastVisited(): string
    {
        return $this->lastVisited;
    }
}
