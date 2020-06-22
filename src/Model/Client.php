<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class Client

{
    /** @var string  */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

}
