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
 */
class ParseOrdersToJsonHandler implements JsonSerializable
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var MessageBusInterface */
    private MessageBusInterface $commandBus;

    /** @var Client */
    private $client;

    public function __construct(SerializerInterface $serializer, MessageBusInterface $commandBus, ?Client $client)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
        $this->client = $client;
    }

    public function __invoke(ParseOrdersToJson $command)
    {
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
