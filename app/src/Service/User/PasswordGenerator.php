<?php


namespace App\Service\User;


use Ramsey\Uuid\Uuid;

class PasswordGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}