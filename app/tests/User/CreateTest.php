<?php

declare(strict_types=1);

namespace App\Tests\User;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testAdminCreate(): void
    {
        $user = User::create('mail@mail.mail', '111', ['ROLE_ADMIN']);

        self::assertEquals('mail@mail.mail', $user->getEmail());
        self::assertEquals('111', $user->getPassword());
        self::assertEquals('mail@mail.mail', $user->getUserIdentifier());
        self::assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles());

    }

    public function testUserCreate(): void
    {
        $user = User::create('some@mail.here', '222');

        self::assertEquals('some@mail.here', $user->getEmail());
        self::assertEquals('222', $user->getPassword());
        self::assertEquals('some@mail.here', $user->getUserIdentifier());
        self::assertEquals(['ROLE_USER'], $user->getRoles());
    }
}
