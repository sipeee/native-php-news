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
        return $_ENV[$key] ?? '';
    }

    public function isProdEnvironment(): string
    {
        return $this->getEnv('APP_ENV') === 'prod';
    }

    public function getDsnConfig(): string
    {
        return sprintf('mysql:host=%s;port=%s;dbname=%s', $this->getEnv('MYSQL_HOST'), $this->getEnv('MYSQL_PORT'), $this->getEnv('MYSQL_DATABASE'));
    }

    private function loadEnvVars()
    {
        Dotenv::createImmutable(__DIR__);
    }
}