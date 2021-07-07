<?php

namespace App\Entity\Price;

use App\Entity\Pizza\Pizza;
use App\Entity\Property\Property;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="prices")
 */
class Price
{
    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Pizza\Pizza")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pizza;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Property\Property")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $price;

    public function __construct(Pizza $pizza, Property $property, int $price, $name = '')
    {
        $this->name = $name;
        $this->pizza = $pizza;
        $this->property = $property;
        $this->price = $price;
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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }


    public function getProperty()
    {
        return $this->property;
    }

    public function setProperty($property): void
    {
        $this->property = $property;
    }

    public function getPizza()
    {
        return $this->pizza;
    }

    public function setPizza($pizza): void
    {
        $this->pizza = $pizza;
    }
}
