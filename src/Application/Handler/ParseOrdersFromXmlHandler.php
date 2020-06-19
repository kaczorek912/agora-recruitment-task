<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\ParseOrdersFromXml;
use App\Application\Command\ParseOrdersToJson;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Model\Client;

/**
 *
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
final class ParseOrdersFromXmlHandler
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /** @var MessageBusInterface  */
    private MessageBusInterface $commandBus;

    public function __construct(SerializerInterface $serializer, MessageBusInterface $commandBus) {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    public function __invoke(ParseOrdersFromXml $command)
    {
        $client = $this->serializer->deserialize($command->getContent(), Client::class, 'xml');

        $this->commandBus->dispatch( new ParseOrdersToJson($client));
    }
}
