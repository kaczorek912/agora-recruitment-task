<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\SaveOrdersPerClientToJsonFile;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class SaveOrdersPerClientToJsonFileHandler
{

    public function __invoke(SaveOrdersPerClientToJsonFile $command)
    {
        $date = date("Y-m-d H:i:s");
        $fileName = "({$command->getClientName()})_report_($date).json";

        $fp = fopen($fileName, 'w');
        fwrite($fp, $command->getJsonData());
        fclose($fp);
    }
}
