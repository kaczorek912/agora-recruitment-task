<?php

declare(strict_types=1);

namespace App\Application\Command;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersFromXlsx
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
