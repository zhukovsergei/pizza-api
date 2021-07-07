<?php

namespace App\Service\Price\Create;

use App\Entity\Price\Price;
use App\Repository\PizzaRepository;
use App\Repository\PriceRepository;
use App\Repository\PropertyRepository;
use App\Service\Doctrine\Flusher;


class Handler
{
    private $priceRepository;
    private $pizzaRepository;
    private $propertyRepository;

    public function __construct(
        PizzaRepository $pizzaRepository,
        PropertyRepository $propertyRepository,
        PriceRepository $priceRepository,
        Flusher $flusher
    )
    {
        $this->priceRepository = $priceRepository;
        $this->pizzaRepository = $pizzaRepository;
        $this->propertyRepository = $propertyRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): Price
    {
        $pizza = $this->pizzaRepository->get($command->pizza_id);
        $property = $this->propertyRepository->get($command->property_id);

        $price = new Price($pizza, $property, $command->price);

        $this->priceRepository->add($price);

        $this->flusher->flush();

        return $price;
    }
}
