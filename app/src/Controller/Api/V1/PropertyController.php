<?php

namespace App\Controller\Api\V1;

use App\ReadModel\Pizza\PropertyFetcher;
use App\Service\Property\Create\Command as CreateCommand;
use App\Service\Property\Create\Form as CreateForm;
use App\Service\Property\Create\Handler as CreateHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Create a new property
     * @Route("/property/create", name="property.create", methods={"POST"})
     */
    public function create(Request $request, CreateHandler $handler): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new CreateCommand();

        $form = $this->createForm(CreateForm::class, $command, [
            'csrf_protection' => false,
        ]);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPizza = $handler->handle($command);
            return $this->json($newPizza);
        }

        throw new \DomainException('Error');
    }
}

