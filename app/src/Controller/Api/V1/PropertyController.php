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
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class PropertyController extends AbstractController
{
    /**
     * Show all properties
     * @Route("/property", name="property.index", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns all properties"
     * )
     * @OA\Tag(name="Property")
     */
    public function index(PropertyFetcher $propertyFetcher): Response
    {
        return $this->json($propertyFetcher->findAll());
    }

    /**
     * Create a new property
     * @Route("/property/create", name="property.create", methods={"POST"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the createed pizza",
     *     @Model(type=App\Entity\Property\Property::class)
     * )
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="The name of property",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Property")
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

