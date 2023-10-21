<?php

namespace App\Domain\Order\DAL\OrderStatus;

use App\Domain\Order\Models\OrderStatus;
use App\DomainUtils\BaseDAL\BaseDALInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderStatusDALInterface extends BaseDALInterface
{
    /**
     * Get list order statuses
     *
     * @return LengthAwarePaginator
     */
    public function getListOrderStatuses(): LengthAwarePaginator;

    /**
     * Find order status by Uuid
     *
     * @param string $uuid
     * @return OrderStatus
     */
    public function findOrderStatusByUuid(string $uuid): OrderStatus;
}
