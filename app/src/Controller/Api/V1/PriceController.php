<?php

namespace App\Controller\Api\V1;

use App\ReadModel\Pizza\PriceFetcher;
use App\Service\Price\Create\Command as CreateCommand;
use App\Service\Price\Create\Form as CreateForm;
use App\Service\Price\Create\Handler as CreateHandler;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceController extends AbstractController
{
    /**
     * Show all prices
     * @Route("/price", name="price.index", methods={"GET"})
     */
    public function index(PriceFetcher $priceFetcher): Response
    {
        return $this->json($priceFetcher->findAll());
    }

    /**
     * Create a new pizza
     * @Route("/price/create", name="price.create", methods={"POST"})
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
            $newPrice = $handler->handle($command);
            return $this->json($newPrice);
        }

        throw new \DomainException('Error');
    }

}
