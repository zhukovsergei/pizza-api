<?php

namespace App\Service\Pizza\Update;

use App\Entity\Pizza\Id;
use App\Entity\Pizza\Pizza;
use App\Repository\PizzaRepository;
use App\Service\Doctrine\Flusher;


class Handler
{
    private $pizzaRepository;
    private $flusher;

    public function __construct(
        PizzaRepository $pizzaRepository,
        Flusher $flusher
    )
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->flusher = $flusher;
    }

    /**
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function handle(Command $command): Pizza
    {
        $pizza = $this->pizzaRepository->get($command->targetUuid);

        $pizza->setName($command->name);

        $this->pizzaRepository->add($pizza);

        $this->flusher->flush();

        return $pizza;
    }
}
