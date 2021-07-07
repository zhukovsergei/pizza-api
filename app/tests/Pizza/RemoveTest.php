<?php

declare(strict_types=1);

namespace App\Tests\Pizza;

use App\Entity\Pizza\Id;
use App\Entity\Pizza\Pizza;
use App\Repository\PizzaRepository;
use App\Service\Doctrine\Flusher;
use App\Service\Pizza\Remove\Command;
use App\Service\Pizza\Remove\Handler;
use PHPUnit\Framework\TestCase;

class RemoveTest extends TestCase
{

    public function testHandlerRemove(): void
    {
        $pizzaForRemove = $this->createMock(Pizza::class);
        $pizzaForRemove->method('getName')->willReturn('removed pizza');
        $pizzaForRemove->method('getId')->willReturn(new Id('34ada516-a840-423d-bb19-0d330c3118c6'));

        $pizzaRepoMock = $this->createMock(PizzaRepository::class);
        $pizzaRepoMock->method('get')->willReturn($pizzaForRemove);
        $flusherMock = $this->createMock(Flusher::class);

        $handler = new Handler($pizzaRepoMock, $flusherMock);

        $commandMock = $this->createMock(Command::class);
        $commandMock->uuid = '34ada516-a840-423d-bb19-0d330c3118c6';
        $pizza = $handler->handle($commandMock);
        self::assertInstanceOf(Pizza::class, $pizza);

        self::assertEquals('34ada516-a840-423d-bb19-0d330c3118c6', $pizza->getId()->getValue());
        self::assertEquals('removed pizza', $pizza->getName());
    }

}
