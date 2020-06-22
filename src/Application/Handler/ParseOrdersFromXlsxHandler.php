<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\ParseOrdersFromXlsx;
use App\Application\Command\ParseOrdersToJson;
use App\Model\Client;
use App\Model\Order;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 *
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersFromXlsxHandler
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /** @var MessageBusInterface */
    private MessageBusInterface $commandBus;

    public function __construct(SerializerInterface $serializer, MessageBusInterface $commandBus)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    public function __invoke(ParseOrdersFromXlsx $command)
    {
        $inputFileType = IOFactory::identify($command->getFileName());

        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($command->getFileName());
        $reader->setReadEmptyCells(false);

        $schdeules = $spreadsheet->getActiveSheet()->toArray();

        foreach ($schdeules as $schdeule) {
            $data[] = (array_filter($schdeule));
        }
        $headers = array_shift($data);

        foreach ($data as $orderData) {
            if (isset($orderData[2]) && is_numeric($orderData[2])) {
                $clients[$orderData[3]] = new Client($orderData[3]);
                $orders[$orderData[3]][] = new Order(
                    $orderData[0],
                    $orderData[1],
                    $orderData[2],
                    new Client($orderData[3]),
                    $orderData[4]
                );
            }
        }

    }
}
