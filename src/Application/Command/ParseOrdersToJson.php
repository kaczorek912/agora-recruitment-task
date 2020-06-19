<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Model\Client;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class ParseOrdersToJson

{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }
}
