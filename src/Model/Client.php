<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
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

    public function sumAllOrders(): float
    {
        $sum = 0;
        foreach ($this->getAllOrders() as $order) {
            $sum += $order->getAmount();
        }

        return $sum;
    }

}
