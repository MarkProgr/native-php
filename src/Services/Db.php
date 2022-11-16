<?php

namespace App\Services;

class Db
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, array $params = [], string $className)
    {
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute($params);

        if (!$result) {
            return null;
        }

        return $statement->fetchAll();
    }
}
