<?php

namespace App\Domain\Order\DAL\OrderStatus;

use App\Domain\Order\Models\OrderStatus;
use App\DomainUtils\BaseDAL\BaseDALInterface;

interface OrderStatusDALInterface extends BaseDALInterface
{
    /**
     * Find order status by Uuid
     *
     * @param string $uuid
     * @return OrderStatus
     */
    public function findOrderStatusByUuid(string $uuid): OrderStatus;
}
