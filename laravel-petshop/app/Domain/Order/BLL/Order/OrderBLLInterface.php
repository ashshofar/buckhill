<?php

namespace App\Domain\Order\BLL\Order;

use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Models\Order;
use App\DomainUtils\BaseBLL\BaseBLLInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderBLLInterface extends BaseBLLInterface
{
    /**
     * Get order list by user id
     *
     * @return LengthAwarePaginator
     */
    public function getListOrders(): LengthAwarePaginator;

    /**
     * Create order
     *
     * @param OrderDTO $order
     * @return Order
     */
    public function createOrder(OrderDTO $order): Order;
}
