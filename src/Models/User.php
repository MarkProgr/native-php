<?php

namespace App\Models;

use App\Services\Db;
use Laminas\Diactoros\ServerRequest;

class User
{
    private int $id;
    private string $email;
    private string $name;
    private string $gender;
    private string $status;

    public function __construct(int $id, string $email, string $name, string $gender, string $status)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->gender = $gender;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}