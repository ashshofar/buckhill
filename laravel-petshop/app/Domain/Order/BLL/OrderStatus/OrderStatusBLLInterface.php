<?php

namespace App\Domain\Order\BLL\OrderStatus;

use App\DomainUtils\BaseBLL\BaseBLLInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderStatusBLLInterface extends BaseBLLInterface
{
    /**
     * Get list statuses
     *
     * @return LengthAwarePaginator
     */
    public function getListStatuses(): LengthAwarePaginator;
}
