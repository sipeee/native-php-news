<?php

namespace App\Model;

use App\EnvConfig;
use App\Model\BcryptEncoder;
use App\Model\Repository;

class LoginSession
{
    private static ?self $instance = null;

    private function __construct()
    {
        $this->initializeSession();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function authorize(): ?array
    {
        if (!isset($_SESSION['loggedin_id'])) {
            return null;
        }

        $repo = new Repository();

        return $repo->queryUserById($_SESSION['loggedin_id']);
    }

    public function authenticate(string $email, string $password): bool
    {
        $user = $this->getAuthenticatedUser($email, $password);

        $result = null !== $user;
        if ($result) {
            $_SESSION['loggedin_id'] = $user['id'];
        }

        return $result;
    }

    private function getAuthenticatedUser(string $email, string $password): ?array
    {
        $repo = new Repository();
        $user = $repo->queryUserByEmail($email);

        if (null === $user) {
            return null;
        }

        $encoder = new BcryptEncoder();

        return ($encoder->verifyPassword($password, $user['password']))
            ? $user
            : null;
    }

    private function initializeSession(): void
    {
        session_start();
    }
}