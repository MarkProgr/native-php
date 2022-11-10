<?php

namespace App\Services;

class Db
{
    private $pdo;
    private static $connection;

    private function __construct()
    {
        $dbSettings = (require __DIR__ . '/../settings.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
            $dbSettings['user'],
            $dbSettings['password']);

        $this->pdo->exec('SET NAMES UTF8');
    }

    public static function connection(): self
    {
        if (self::$connection === null) {
            self::$connection = new self();
        }

        return self::$connection;
    }

    public function query(string $sql, array $params = [], string $className)
    {
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute($params);

        if (!$result) {
            return null;
        }

        return $statement->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}

