<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @author Mateusz Kaczorowski <mateusz.kaczorowski@iiit.pl>
 */
class Client
{
    /** @var string */
    public $name;

    /** @var Order[] */
    public $orders;

    /**
     * @param string $name
     */
    public function __construct(string $name, array $orders)
    {
        $this->name = $name;
        $this->orders = $orders;
    }

    public function getAllOrders(): array
    {
        return $this->orders;
    }

    public function sumAllOrders()
    {
        $sum = 0;
        foreach ($this->getAllOrders() as $order) {
            $sum += $order->getAmount();
        }

        return $sum;
    }

}
