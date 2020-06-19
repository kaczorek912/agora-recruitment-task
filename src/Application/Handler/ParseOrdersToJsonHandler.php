<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\ParseOrdersFromXml;
use App\Application\Command\ParseOrdersToJson;
use App\Model\Client;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class ParseOrdersToJsonHandler
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

    public function __invoke(ParseOrdersToJson $command)
    {
        $client = $this->serializer->serialize($command->getClient(), 'json');
        // tu zapis do pliku lub message do komendy, która to obsłuzy(lepsze chyba 2 rozwiązanie)
    }
}
