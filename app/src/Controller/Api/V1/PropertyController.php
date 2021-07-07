<?php

namespace App\Controller\Api\V1;

use App\ReadModel\Pizza\PizzaFetcher;
use App\ReadModel\Pizza\PropertyFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("/property", name="property.index", methods={"GET"})
     */
    public function index(PropertyFetcher $propertyFetcher): Response
    {
        return $this->json($propertyFetcher->findAll());
    }
}
