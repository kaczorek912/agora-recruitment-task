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
    public $clientName;

    /** @var string */
    private $orderNumber;

    /**
     * @param string $courier
     * @param string $waybillNumber
     * @param float $amount
     * @param string $clientName
     * @param string $orderNumber
     */
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

    /**
     * @return string
     */
    public function getCourier(): string
    {
        return $this->courier;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @return string
     */
    public function getWaybillNumber(): string
    {
        return $this->waybillNumber;
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
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

}
