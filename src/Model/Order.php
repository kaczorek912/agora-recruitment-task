<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class Order
{
    /** @var string */
    private $courier;

    /** @var string */
    private $waybillNumber;

    /** @var float */
    private $amount;

    /** @var string */
    private $clientName;

    /** @var string */
    private $orderNumber;

    public function __construct(
        string $courier,
        string $waybillNumber,
        float $amount,
        string $clientName,
        string $orderNumber
    ) {
        $this->courier = $courier;
        $this->waybillNumber = $waybillNumber;
        $this->amount = $amount;
        $this->clientName = $clientName;
        $this->orderNumber = $orderNumber;
    }

    public function getCourier(): string
    {
        return $this->courier;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getWaybillNumber(): string
    {
        return $this->waybillNumber;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }
}
