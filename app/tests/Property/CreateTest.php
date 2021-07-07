<?php

declare(strict_types=1);

namespace App\Tests\Property;

use App\Entity\Property\Id;
use App\Entity\Property\Property;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testAdminCreate(): void
    {
        $pizza = new Property(Id::next(), 'propname');

        self::assertInstanceOf(Id::class, $pizza->getId());

        self::assertMatchesRegularExpression('/[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}/', $pizza->getId()->getValue());
        self::assertEquals('propname', $pizza->getName());

    }

}
