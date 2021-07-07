<?php

declare(strict_types=1);

namespace App\Tests\Price;

use App\Entity\Pizza\Pizza;
use App\Entity\Price\Price;
use App\Entity\Property\Property;

use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testCreate(): void
    {
        $pizzaMock = $this->createMock(Pizza::class);
        $propMock = $this->createMock(Property::class);

        $price = new Price($pizzaMock, $propMock, 10);

        self::assertEquals(10, $price->getPrice());
        self::assertEmpty($price->getName());
        self::assertInstanceOf(Pizza::class, $price->getPizza());
        self::assertInstanceOf(Property::class, $price->getProperty());

    }
}
