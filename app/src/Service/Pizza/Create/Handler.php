<?php

namespace App\Service\Pizza\Create;

use App\Entity\Pizza\Id;
use App\Entity\Pizza\Pizza;
use App\Repository\PizzaRepository;
use App\Service\Doctrine\Flusher;


class Handler
{

    private $pizzaRepository;

    public function __construct(
        PizzaRepository $pizzaRepository,
        Flusher $flusher
    )
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): Pizza
    {
        $pizza = new Pizza(Id::next(), $command->name);

        $this->pizzaRepository->add($pizza);

        $this->flusher->flush();

        return $pizza;
    }
}
