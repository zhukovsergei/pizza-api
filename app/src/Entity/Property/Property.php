<?php

namespace App\Entity\Property;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="properties", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"name"})
 * })
 */
class Property
{
    /**
     * @ORM\Column(type="propery_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Price\Price", mappedBy="property")
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
