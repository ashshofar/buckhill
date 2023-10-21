<?php

namespace App\Domain\Order\BLL\OrderStatus;

use App\Domain\Order\DAL\OrderStatus\OrderStatusDALInterface;
use App\DomainUtils\BaseBLL\BaseBLL;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderStatusBLL extends BaseBLL implements OrderStatusBLLInterface
{
    public function __construct(public OrderStatusDALInterface $orderStatusDAL)
    {}

    /**
     * Get list statuses
     *
     * @return LengthAwarePaginator
     */
    public function getListStatuses(): LengthAwarePaginator
    {
        return $this->orderStatusDAL->getListOrderStatuses();
    }
}
