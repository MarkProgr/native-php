<?php

namespace App\Repository;

use App\Services\Db;
use DateTime;

class SiteUserRepository
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function login(array $params): ?bool
    {
        $siteUser = $this->db->query(
            'SELECT * FROM site_users WHERE login = :login',
            [':login' => $params['login']],
            static::class
        );

        if (empty($siteUser)) {
            return null;
        }

        if (!password_verify($params['password'], $siteUser[0]['password'])) {
            return null;
        }

        $currentTime = new DateTime();
        $this->db->query(
            'UPDATE site_users SET last_visited = :lastVisited WHERE login = :login',
            [':login' => $params['login'],
                ':lastVisited' => $currentTime->format('d-m-Y')],
            static::class
        );

        session_start();

        $_SESSION = ['id' => $siteUser[0]['id']];

        return true;
    }

    public function signUp(array $params)
    {
        $password = $params['password'];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $this->db->query(
            'INSERT INTO site_users (login, password) VALUES (:login, :password)',
            [':login' => $params['login'],
                ':password' => $passwordHash],
            static::class
        );
    }

    public function logout(): void
    {
        session_start();

        $_SESSION = [];
    }
}
