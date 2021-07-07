<?php

declare(strict_types=1);

namespace App\Tests\Pizza;

use App\Entity\Pizza\Id;
use App\Entity\Pizza\Pizza;
use App\Repository\PizzaRepository;
use App\Service\Doctrine\Flusher;
use App\Service\Pizza\Create\Command;
use App\Service\Pizza\Create\Handler;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testCreate(): void
    {
        $pizza = new Pizza(Id::next(), 'pzzaname');

        self::assertInstanceOf(Id::class, $pizza->getId());

        self::assertMatchesRegularExpression('/[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}/', $pizza->getId()->getValue());
        self::assertEquals('pzzaname', $pizza->getName());
    }

    public function testHandlerCreate(): void
    {
        $pizzaRepoMock = $this->createMock(PizzaRepository::class);
        $flusherMock = $this->createMock(Flusher::class);

        $handler = new Handler($pizzaRepoMock, $flusherMock);

        $commandMock = $this->createMock(Command::class);
        $commandMock->name = 'NEW NAME';
        $pizza = $handler->handle($commandMock);
        self::assertInstanceOf(Pizza::class, $pizza);

        self::assertMatchesRegularExpression('/[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}/', $pizza->getId()->getValue());
        self::assertEquals('NEW NAME', $pizza->getName());
    }

}
