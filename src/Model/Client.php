<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class Client
{
    private string $name;

    /** @var Order[] */
    private $orders;

    public function __construct(string $name, array $orders)
    {
        $this->name = $name;
        $this->orders = $orders;
    }

    public function getName(): string
    {
        return $this->name;
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
