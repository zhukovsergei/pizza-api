<?php


namespace App\Service\Pizza\Update;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $targetUuid;

    /**
     * @Assert\NotBlank()
     */
    public $name;

    public function __construct($targetUuid)
    {
        $this->targetUuid = $targetUuid;
    }

}