<?php

namespace Blog\Utilities;

class DBConnection
{
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = '';
    private const DBNAME = 'blog';
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME;
        $this->pdo = new \PDO($dsn, self::USER, self::PASSWORD);
    }

    /**
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
