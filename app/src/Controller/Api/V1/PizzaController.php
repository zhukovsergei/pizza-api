<?php

namespace App\Controller\Api\V1;

use App\ReadModel\Pizza\PizzaFetcher;
use App\Service\Pizza\Create\Command as CreateCommand;
use App\Service\Pizza\Create\Form as CreateForm;
use App\Service\Pizza\Create\Handler as CreateHandler;
use App\Service\Pizza\Update\Command as UpdateCommand;
use App\Service\Pizza\Update\Form as UpdateForm;
use App\Service\Pizza\Update\Handler as UpdateHandler;
use App\Service\Pizza\Remove\Command as RemoveCommand;
use App\Service\Pizza\Remove\Form as RemoveForm;
use App\Service\Pizza\Remove\Handler as RemoveHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * Show all pizzas
     * @Route("/pizza", name="pizza.index", methods={"GET"})
     */
    public function index(PizzaFetcher $pizzaFetcher): Response
    {
        return $this->json($pizzaFetcher->findAll());
    }

    /**
     * Create a new pizza
     * @Route("/pizza/create", name="pizza.create", methods={"POST"})
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

    /**
     * Update a pizza by name
     * @Route("/pizza/update/{targetName}", name="pizza.update", methods={"PATCH"})
     */
    public function update(string $targetName, Request $request, UpdateHandler $handler): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new UpdateCommand($targetName);

        $form = $this->createForm(UpdateForm::class, $command, [
            'csrf_protection' => false,
        ]);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPizza = $handler->handle($command);
            return $this->json($newPizza);
        }

        throw new \DomainException('Error');
    }

    /**
     * Remove a pizza by name
     * @Route("/pizza/remove", name="pizza.remove", methods={"DELETE"})
     */
    public function remove(Request $request, RemoveHandler $handler): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new RemoveCommand();

        $form = $this->createForm(RemoveForm::class, $command, [
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
