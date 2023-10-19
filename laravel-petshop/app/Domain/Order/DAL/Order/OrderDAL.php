<?php

namespace App\Domain\Order\DAL\Order;

use App\Domain\Product\Models\Product;
use App\DomainUtils\BaseDAL\BaseDAL;
use App\Domain\Order\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @property Order model
 */
class OrderDAL extends BaseDAL implements OrderDALInterface
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * Get order list by user id
     *
     * @param int $userId
     * @return LengthAwarePaginator
     */
    public function getListOrder(int $userId): LengthAwarePaginator
    {
        $limit = request('limit');
        $desc = request('desc');

        $orders = $this->model->query();

        $orders->with(['payment', 'user', 'orderStatus'])
            ->where('user_id', $userId);

        if ($desc) {
            $orders->orderBy('created_at', 'DESC');
        } else {
            $orders->orderBy('created_at', 'ASC');
        }

        return $orders->paginate($limit);
    }
}
