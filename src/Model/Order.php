<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class Order
{
    /** @var string */
    private $forwarder;

    /** @var string */
    private $trackingNumber;

    /** @var float */
    private $amount;

    /** @var Client */
    private $client;

    /** @var string */
    private $orderId;

    /**
     * @param string $forwarder
     * @param string $trackingNumber
     * @param float $amount
     * @param Client $client
     * @param string $orderId
     */
    public function __construct(
        string $forwarder,
        string $trackingNumber,
        float $amount,
        Client $client,
        string $orderId
    ) {
        $this->forwarder = $forwarder;
        $this->trackingNumber = $trackingNumber;
        $this->amount = $amount;
        $this->client = $client;
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getForwarder(): string
    {
        return $this->forwarder;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }


}
