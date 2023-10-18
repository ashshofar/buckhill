<?php

namespace App\Domain\Order\BLL\Order;

use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Models\Order;
use App\DomainUtils\BaseBLL\BaseBLLInterface;

interface OrderBLLInterface extends BaseBLLInterface
{
    /**
     * Create order
     *
     * @param OrderDTO $order
     * @return Order
     */
    public function createOrder(OrderDTO $order): Order;
}
