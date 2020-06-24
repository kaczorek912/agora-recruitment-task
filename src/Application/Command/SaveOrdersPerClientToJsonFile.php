<?php

declare(strict_types=1);

namespace App\Application\Command;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowsk3@gmail.com>
 */
class SaveOrdersPerClientToJsonFile
{
    private string $jsonData;

    private string $clientName;

    public function __construct(string $jsonData, string $clientName)
    {
        $this->jsonData = $jsonData;
        $this->clientName = $clientName;
    }

    public function getJsonData(): string
    {
        return $this->jsonData;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }
}
