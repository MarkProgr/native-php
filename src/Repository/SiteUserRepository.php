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
            'SELECT * FROM site_users WHERE login = :login AND password = :password',
            [':login' => $params['login'],
            ':password' => $params['password']],
            static::class
        );

        if (empty($siteUser)) {
            return null;
        }

        $currentTime = new DateTime();
        $this->db->query(
            'UPDATE site_users SET last_visited = :lastVisited WHERE login = :login AND password = :password',
            [':login' => $params['login'],
                ':password' => $params['password'],
                ':lastVisited' => $currentTime->format('d-m-Y')],
            static::class
        );

        session_start();

        return true;
    }

    public function logout(): void
    {
        setcookie('PHPSESSID', '', time() - 60);
    }
}
