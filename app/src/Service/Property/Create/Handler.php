<?php

namespace App\Service\Property\Create;

use App\Entity\Property\Id;
use App\Entity\Property\Property;
use App\Repository\PropertyRepository;
use App\Service\Doctrine\Flusher;


class Handler
{
    private $propertyRepository;

    public function __construct(
        PropertyRepository $propertyRepository,
        Flusher $flusher
    )
    {
        $this->propertyRepository = $propertyRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): Property
    {
        $pizza = new Property(Id::next(), $command->name);

        $this->propertyRepository->add($pizza);

        $this->flusher->flush();

        return $pizza;
    }
}
