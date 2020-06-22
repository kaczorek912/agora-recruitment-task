<?php

declare(strict_types=1);
namespace App\Application\Command;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersFromXlsx
{
    /** @var string  */
    private $fileName;


    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;

    }

    public function getFileName()
    {
        return $this->fileName;

    }
}
