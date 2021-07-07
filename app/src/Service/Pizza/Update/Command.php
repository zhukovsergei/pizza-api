<?php


namespace App\Service\Pizza\Update;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $targetName;

    /**
     * @Assert\NotBlank()
     */
    public $name;

    public function __construct($targetName)
    {
        $this->targetName = $targetName;
    }

}