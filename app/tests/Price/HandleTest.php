<?php

declare(strict_types=1);

namespace App\Tests\Price;

use App\Entity\Pizza\Id as PizzaId;
use App\Entity\Property\Id as PropertyId;
use App\Entity\Pizza\Pizza;
use App\Entity\Price\Price;
use App\Entity\Property\Property;
use App\Repository\PizzaRepository;
use App\Repository\PriceRepository;
use App\Repository\PropertyRepository;
use App\Service\Doctrine\Flusher;
use App\Service\Price\Create\Command;
use App\Service\Price\Create\Handler;
use PHPUnit\Framework\TestCase;

class HandleTest extends TestCase
{
    public function testHandleCreate(): void
    {
        $pizzaRepoMock = $this->createMock(PizzaRepository::class);
        $pizzaRepoMock->method('get')->willReturn(new Pizza(new PizzaId('8464cc37-2191-4917-8e32-1a55639370a6'), 'name'));

        $propRepoMock = $this->createMock(PropertyRepository::class);
        $propRepoMock->method('get')->willReturn(new Property(new PropertyId('d78175a7-ccfa-44bb-b1fd-f1cafbbec1c1'), 'name'));

        $priceRepoMock = $this->createMock(PriceRepository::class);
        $flusherMock = $this->createMock(Flusher::class);

        $handler = new Handler($pizzaRepoMock, $propRepoMock, $priceRepoMock, $flusherMock);

        $commandMock = $this->createMock(Command::class);
        $commandMock->price = 228;
        $price = $handler->handle($commandMock);
        self::assertInstanceOf(Price::class, $price);

        self::assertEquals('8464cc37-2191-4917-8e32-1a55639370a6', $price->getPizza()->getId()->getValue());
        self::assertEquals('d78175a7-ccfa-44bb-b1fd-f1cafbbec1c1', $price->getProperty()->getId()->getValue());
        self::assertEquals(228, $price->getPrice());
    }

}
