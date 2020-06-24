<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Command\ParseOrdersToJson;
use App\Application\Command\SaveOrdersPerClientToJsonFile;
use App\Model\Client;
use JsonSerializable;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ParseOrdersToJsonHandler implements JsonSerializable
{
    private SerializerInterface $serializer;

    private MessageBusInterface $commandBus;

    private Client $client;

    public function __construct(SerializerInterface $serializer, MessageBusInterface $commandBus)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    public function __invoke(ParseOrdersToJson $command)
    {
        $clientOrders = [];
        foreach ($command->getOrders() as $order) {
            $clientOrders[$order->getClientName()][] = $order;
        }
        foreach ($clientOrders as $name => $clientOrder) {
            $this->client = new Client($name, $clientOrder);
            $serializedOrders = $this->serializer->serialize(
                $this->jsonSerialize(),
                'json',
                [AbstractNormalizer::IGNORED_ATTRIBUTES => ['clientName']]
            );

            $this->commandBus->dispatch(new SaveOrdersPerClientToJsonFile($serializedOrders, $this->client->getName()));
        }
    }

    public function jsonSerialize()
    {
        return [
            'data' => [
                $this->client->getAllOrders(),
            ],
            'sum' => $this->client->sumAllOrders(),
        ];
    }
}
