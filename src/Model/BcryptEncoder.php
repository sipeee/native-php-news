<?php

namespace App\Model;

class BcryptEncoder
{
    public function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}