<?php

namespace App\Entity\Price;

use App\Entity\Pizza\Pizza;
use App\Entity\Property\Property;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="prices")
 */
class Price
{
    /**
     * Name
     * @ORM\Column(type="string", length=255)
     * @OA\Property(type="string", description="Name is optional"))
     */
    private $name;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Pizza\Pizza", inversedBy="prices")
     * @ORM\JoinColumn(nullable=false)
     *
     * @OA\Property(type="string", format="uuid", ref=@Model(type=App\Entity\Pizza\Pizza::class))
     */
    private $pizza;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Property\Property", inversedBy="prices")
     * @ORM\JoinColumn(nullable=false)
     *
     * @OA\Property(type="string", format="uuid", ref=@Model(type=App\Entity\Property\Property::class))
     */
    private $property;

    /**
     * @ORM\Column(type="integer", length=10)
     *
     * @OA\Property(description="Price")
     */
    private $price;

    public function __construct(Pizza $pizza, Property $property, int $price, $name = '')
    {
        $this->name = $name;
        $this->pizza = $pizza;
        $this->property = $property;
        $this->price = $price;
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
