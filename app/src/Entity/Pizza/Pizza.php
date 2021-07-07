<?php

namespace App\Entity\Pizza;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

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
     * @OA\Property(type="string", format="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @OA\Property(description="Name for pizza")
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Price\Price", mappedBy="pizza")
     * @OA\Property(ref=@Model(type=App\Entity\Price\Price::class))
     */
    private $prices;

    public function __construct(Id $id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?Id
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
