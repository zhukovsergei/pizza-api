<?php

namespace App\DataFixtures;

use App\Entity\Pizza\Id as PizzaId;
use App\Entity\Price\Price;
use App\Entity\Property\Id as PropertyId;;
use App\Entity\Pizza\Pizza;
use App\Entity\Property\Property;
use App\Repository\PizzaRepository;
use App\Repository\PriceRepository;
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
    private $priceRepository;

    public function __construct(PizzaRepository $pizzaRepository, PropertyRepository $propertyRepository, PriceRepository $priceRepository, Flusher $flusher)
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->propertyRepository = $propertyRepository;
        $this->priceRepository = $priceRepository;
        $this->flusher = $flusher;
    }

    public function load(ObjectManager $manager)
    {
        $pizza1 = new Pizza(PizzaId::next(), 'Margarita');
        $pizza2 = new Pizza(PizzaId::next(), 'Trattoria');
        $pizza3 = new Pizza(PizzaId::next(), 'Hawaii');
        $this->pizzaRepository->add($pizza1);
        $this->pizzaRepository->add($pizza2);
        $this->pizzaRepository->add($pizza3);

        $prop1 = new Property(PropertyId::next(), 'Vegan');
        $prop2 = new Property(PropertyId::next(), 'Sweet');
        $prop3 = new Property(PropertyId::next(), 'Spicy');
        $this->propertyRepository->add($prop1);
        $this->propertyRepository->add($prop2);
        $this->propertyRepository->add($prop3);


        $price1 = new Price($pizza1, $prop1, 50);
        $price2 = new Price($pizza1, $prop2, 60);
        $price3 = new Price($pizza1, $prop3, 70);

        $price4 = new Price($pizza2, $prop1, 100);
        $price5 = new Price($pizza2, $prop2, 110);

        $price6 = new Price($pizza3, $prop1, 150);

        $this->priceRepository->add($price1);
        $this->priceRepository->add($price2);
        $this->priceRepository->add($price3);
        $this->priceRepository->add($price4);
        $this->priceRepository->add($price5);
        $this->priceRepository->add($price6);

        $this->flusher->flush();
    }

    public static function getGroups(): array
    {
        return ['pizzas'];
    }
}
