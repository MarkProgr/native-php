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
            $result[] = new User(
                $user['id'],
                $user['email'],
                $user['name'],
                $user['gender'],
                $user['status'],
                $user['image_name']
            );
        }

        return $result;
    }

    public function selectById(array $params): ?User
    {
        $user = $this->db->query(
            "SELECT * FROM `users` WHERE id = :id;",
            [':id' => $params['id']],
            static::class
        );

        if (empty($user)) {
            return null;
        }

        return new User(
            $params['id'],
            $user[0]['email'],
            $user[0]['name'],
            $user[0]['gender'],
            $user[0]['status'],
            $user[0]['image_name']
        );
    }

    public function update(int $id, array $params, ?string $uniqueImageName): void
    {
        $this->db->query(
            "UPDATE users SET email = :email, name = :name, 
                 gender = :gender, status = :status, image_name = :imageName WHERE id = :id",
            [':id' => $id,
                ':email' => $params['email'],
                ':name' => $params['name'],
                ':gender' => $params['gender'],
                ':status' => $params['status'],
                ':imageName' => $uniqueImageName],
            static::class
        );
    }

    public function create(array $params, ?string $uniqueImageName): void
    {
        $this->db->query(
            "INSERT INTO users (email, name, gender, status, image_name) VALUES 
                                                            (:email, :name, :gender, :status, :imageName)",
            [':email' => $params['email'],
                ':name' => $params['name'],
                ':gender' => $params['gender'],
                ':status' => $params['status'],
                ':imageName' => $uniqueImageName],
            static::class
        );
    }

    public function delete(array $params): void
    {
        $imageName = $this->db->query(
            'SELECT image_name FROM users WHERE id = :id',
            [':id' => $params['id']],
            static::class
        );

        if ($imageName[0]['image_name']) {
            $usersImageName = __DIR__ . '/../../public/uploads/' . $imageName[0]['image_name'];
            unlink($usersImageName);
        }

        $this->db->query(
            'DELETE FROM users WHERE id = :id',
            [':id' => $params['id']],
            static::class
        );
    }
}
