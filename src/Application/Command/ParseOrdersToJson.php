<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Model\Order;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class ParseOrdersToJson

{
    /** @var Order[] */
    private $orders;

    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    public function getOrders(): array
    {
        return $this->orders;
    }
}
