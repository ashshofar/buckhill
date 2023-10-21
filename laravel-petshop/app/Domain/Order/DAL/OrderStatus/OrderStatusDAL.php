<?php

namespace App\Domain\Order\DAL\OrderStatus;

use App\Domain\Order\Models\OrderStatus;
use App\DomainUtils\BaseDAL\BaseDAL;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * Get list order statuses
     *
     * @return LengthAwarePaginator
     */
    public function getListOrderStatuses(): LengthAwarePaginator
    {
        $limit = request('limit');
        $desc = request('desc');
        $sortBy = 'title';

        if (in_array(request('sortBy'), OrderStatus::SORT_FIELD)) {
            $sortBy = request('sortBy');
        }

        $orderStatus = $this->model->query();

        if ($desc) {
            $orderStatus->orderBy($sortBy, 'DESC');
        } else {
            $orderStatus->orderBy($sortBy, 'ASC');
        }

        return $orderStatus->paginate($limit);
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
