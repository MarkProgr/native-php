<?php

namespace App\Repository;

use App\Models\User;
use App\Services\Db;

class UserRepository
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function selectAll(): array
    {
        $users = $this->db->query('SELECT * FROM `users`;', [], static::class);

        $result = [];
        foreach ($users as $user) {
            $result[] = new User($user['id'], $user['email'], $user['name'], $user['gender'], $user['status']);
        }

        return $result;
    }

    public function selectById(array $params): ?User
    {
        $user = $this->db->query("SELECT * FROM `users` WHERE id = :id;", [':id' => $params['id']],
            static::class);
//        var_dump($user);
        if (empty($user)) {
            return null;
        }

        return new User($params['id'], $user[0]['email'], $user[0]['name'], $user[0]['gender'], $user[0]['status']);
    }

    public function update(int $id, array $params): void
    {
        $this->db->query("UPDATE users SET email = :email, name = :name, 
                 gender = :gender, status = :status WHERE id = :id",
            [':id' => $id,
                ':email' => $params['email'],
                ':name' => $params['name'],
                ':gender' => $params['gender'],
                ':status' => $params['status']],
            static::class);
    }

    public function create(array $params): void
    {
        $this->db->query("INSERT INTO users (email, name, gender, status) VALUES 
                                                            (:email, :name, :gender, :status)",
            [':email' => $params['email'],
                ':name' => $params['name'],
                ':gender' => $params['gender'],
                ':status' => $params['status']],
            static::class);
    }

    public function delete(array $params): void
    {
        $this->db->query('DELETE FROM users WHERE id = :id',
            [':id' => $params['id']],
            static::class);
    }
}