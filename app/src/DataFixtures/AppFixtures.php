<?php

namespace App\DataFixtures;

use App\Entity\Pizza\Id as PizzaId;
use App\Entity\Property\Id as PropertyId;;
use App\Entity\Pizza\Pizza;
use App\Entity\Property\Property;
use App\Repository\PizzaRepository;
use App\Repository\PropertyRepository;
use App\Service\Doctrine\Flusher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private $pizzaRepository;
    private $propertyRepository;
    private $flusher;

    public function __construct(PizzaRepository $pizzaRepository, PropertyRepository $propertyRepository, Flusher $flusher)
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->propertyRepository = $propertyRepository;
        $this->flusher = $flusher;
    }

    public function load(ObjectManager $manager)
    {
        $this->pizzaRepository->add(new Pizza(PizzaId::next(), 'Margarita'));
        $this->pizzaRepository->add(new Pizza(PizzaId::next(), 'Trattoria'));
        $this->pizzaRepository->add(new Pizza(PizzaId::next(), 'Hawaii'));

        $this->propertyRepository->add(new Property(PropertyId::next(), 'Vegan'));
        $this->propertyRepository->add(new Property(PropertyId::next(), 'Sweet'));
        $this->propertyRepository->add(new Property(PropertyId::next(), 'Spicy'));

        $this->flusher->flush();
    }

    public static function getGroups(): array
    {
        return ['pizzas'];
    }
}
