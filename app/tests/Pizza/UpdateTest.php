<?php

declare(strict_types=1);

namespace App\Tests\Pizza;

use App\Entity\Pizza\Id;
use App\Entity\Pizza\Pizza;
use App\Repository\PizzaRepository;
use App\Service\Doctrine\Flusher;
use App\Service\Pizza\Update\Command;
use App\Service\Pizza\Update\Handler;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{
    public function testHandlerUpdate(): void
    {
        $pizzaForUpdate = new Pizza(new Id('a77670e9-612b-4e31-a761-9ab75d06b056'), 'old name');

        $pizzaRepoMock = $this->createMock(PizzaRepository::class);
        $pizzaRepoMock->method('get')->willReturn($pizzaForUpdate);
        $flusherMock = $this->createMock(Flusher::class);

        $handler = new Handler($pizzaRepoMock, $flusherMock);

        $commandMock = $this->createMock(Command::class);
        $commandMock->targetUuid = 'a77670e9-612b-4e31-a761-9ab75d06b056';
        $commandMock->name = 'new name';
        $pizza = $handler->handle($commandMock);


        self::assertInstanceOf(Pizza::class, $pizza);
        self::assertEquals('a77670e9-612b-4e31-a761-9ab75d06b056', $pizza->getId()->getValue());
        self::assertEquals('new name', $pizza->getName());
    }

}
