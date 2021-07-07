<?php

namespace App\Entity\Pizza;

use App\Repository\PizzaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="pizzas", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"name"})
 * })
 */
class Pizza
{
    /**
     * @ORM\Column(type="pizza_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct(Id $id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
