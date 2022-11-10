<?php

namespace App\Models;

use App\Services\Db;
use Laminas\Diactoros\ServerRequest;

class User
{
    private $id;
    private $email;
    private $name;
    private $gender;
    private $status;

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

    public function setEmail(string $value)
    {
        $this->email = $value;
    }

    public static function selectAll(): array
    {
        $db = Db::connection();

        return $db->query('SELECT * FROM `users`;', [], static::class);
    }

    public static function selectById(array $params): ?User
    {
        $db = Db::connection();

        $user = $db->query("SELECT * FROM `users` WHERE id = :id;", [':id' => $params['id']],
            static::class);

        return $user ? $user[0] : null;
    }

    public static function create()
    {
        $db = Db::connection();

        return $db->query("INSERT INTO users (email, name, gender, status) VALUES 
                                                            (:email, :name, :gender, :status)",
            [':email' => $_POST['email'],
                ':name' => $_POST['name'],
                ':gender' => $_POST['gender'],
                ':status' => $_POST['status']],
            static::class);
    }

    public static function update(array $params)
    {
        $db = Db::connection();

        $db->query("UPDATE users SET email = :email, name = :name, 
                 gender = :gender, status = :status WHERE id = :id",
            [':id' => $params['id'],
                ':email' => $_POST['email'],
                ':name' => $_POST['name'],
                ':gender' => $_POST['gender'],
                ':status' => $_POST['status']],
            static::class);
    }

    public static function delete(array $params)
    {
        $db = Db::connection();

        $db->query('DELETE FROM users WHERE id = :id',
        [':id' => $params['id']],
        static::class);
    }
}