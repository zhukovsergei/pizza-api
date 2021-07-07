<?php


namespace App\Service\Price\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $pizza_id;

    /**
     * @Assert\NotBlank()
     */
    public $property_id;

    /**
     * @Assert\NotBlank()
     */
    public $price;

}