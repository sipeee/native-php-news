<?php

namespace App\Model;

use App\EnvConfig;

class ConnectionProvider
{
    private static ?self $instance = null;

    private ?\PDO $connection = null;

    private function __construct() {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        if ($this->connection === null) {
            $this->connection = $this->createDbConnection();
        }

        return $this->connection;
    }


    private function createDbConnection(): \PDO
    {
        $envConfig = EnvConfig::getInstance();
        $dbh = new \PDO($envConfig->getDsnConfig(), $envConfig->getEnv('MYSQL_USER'), $envConfig->getEnv('MYSQL_PASSWORD'));
        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $dbh;
    }
}