<?php

namespace App\DataFixtures;

use App\Entity\Pizza\Id;
use App\Entity\Pizza\Pizza;
use App\Repository\PizzaRepository;
use App\Service\Doctrine\Flusher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private $pizzaRepository;
    private $flusher;

    public function __construct(PizzaRepository $pizzaRepository, Flusher $flusher)
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->flusher = $flusher;
    }

    public function load(ObjectManager $manager)
    {
        $this->pizzaRepository->add(new Pizza(Id::next(), 'Margarita'));
        $this->pizzaRepository->add(new Pizza(Id::next(), 'Trattoria'));
        $this->pizzaRepository->add(new Pizza(Id::next(), 'Hawaii'));

        $this->flusher->flush();
    }

    public static function getGroups(): array
    {
        return ['pizzas'];
    }
}
