<?php

namespace App;

use Dotenv\Dotenv;

class EnvConfig
{
    private static ?self $instance = null;

    private function __construct()
    {
        $this->loadEnvVars();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getEnv(string $key): string
    {
        return getenv($key);
    }

    public function getDsnConfig(): string
    {
        return sprintf('mysql:host=%s;port=%s;dbname=%s', $this->getEnv('MYSQL_HOST'), $this->getEnv('MYSQL_PORT'), $this->getEnv('MYSQL_DATABASE'));
    }

    /**
     * @return bool
     */
    public function createDbConnection(): \PDO
    {
        $dbh = new \PDO($this->getDsnConfig(), $this->getEnv('MYSQL_USER'), $this->getEnv('MYSQL_PASSWORD'));
        $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $dbh;
    }

    private function loadEnvVars()
    {
        Dotenv::createImmutable(__DIR__);
    }
}