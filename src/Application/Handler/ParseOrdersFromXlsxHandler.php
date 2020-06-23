<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\ParseOrdersFromXlsx;
use App\Application\Command\ParseOrdersToJson;
use App\Model\Order;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersFromXlsxHandler
{
    /** @var MessageBusInterface */
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(ParseOrdersFromXlsx $command)
    {
        $inputFileType = IOFactory::identify($command->getFileName());

        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($command->getFileName());
        $worksheet = $spreadsheet->getActiveSheet();

        $rows = [];
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cells = [];
            foreach ($cellIterator as $cell) {
                if ('null' !== $cell->getDataType()) {
                    $cells[] = $cell->getValue();
                }
            }
            $rows[] = $cells;
        }

        array_shift($rows);

        $orders = array_map(
            static function ($orderData) {
                return new Order($orderData[0], $orderData[1], $orderData[2], $orderData[3], $orderData[4]);
            },
            array_filter($rows)
        );

        $this->commandBus->dispatch(new ParseOrdersToJson($orders));
    }
}
