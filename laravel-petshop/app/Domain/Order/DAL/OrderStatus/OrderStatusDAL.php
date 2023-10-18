<?php

namespace App\Domain\Order\DAL\OrderStatus;

use App\Domain\Order\Models\OrderStatus;
use App\DomainUtils\BaseDAL\BaseDAL;

/**
 * @property OrderStatus model
 */
class OrderStatusDAL extends BaseDAL implements OrderStatusDALInterface
{
    public function __construct(OrderStatus $orderStatus)
    {
        $this->model = $orderStatus;
    }

    /**
     * Find order status by Uuid
     *
     * @param string $uuid
     * @return OrderStatus
     */
    public function findOrderStatusByUuid(string $uuid): OrderStatus
    {
        return $this->model->where('uuid', $uuid)->firstOrFail();
    }
}
