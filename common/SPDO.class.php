<?php

namespace common;

use PDO;
use PDOStatement;

class SPDO
{
    /**
     * instance of PDO
     */
    private PDO $PDOInstance;
    private PDOStatement $statement;

    /**
     * instance of SPDO
     */
    private static SPDO $instance;

    const DEFAULT_SQL_USER = 'bjxo0033_chaliceautumn';
    const DEFAULT_SQL_HOST = 'localhost';
    const DEFAULT_SQL_PASS = 'Chalice4Autumn!';
    const DEFAULT_SQL_DTB = 'bjxo0033_chaliceautumn';

    /**
     * constructor
     */
    private function __construct()
    {
        $this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
    }

    /**
     * create and return SPDO object
     */
    public static function getInstance(): SPDO
    {
        if(!isset(self::$instance))
        {
            self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function execPrepare(string $query): void
    {
        $this->statement = $this->PDOInstance->prepare($query);
    }

    public function execBindValue(string $name, mixed $value, string $type): void
    {
        $this->statement->bindValue($name, $value, $type);
    }

    public function execQuery(bool $isOneRow = false): array|bool
    {
        if (!$this->execStatement()) {
            return false;
        }


        if ($isOneRow) {
            return $this->statement->fetch();
        }

        return $this->statement->fetchAll();
    }

    public function execStatement(): bool
    {
        if (!$this->statement->execute()) {
            return false;
        }
        return true;
    }


}