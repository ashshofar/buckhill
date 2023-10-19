<?php

namespace App\Domain\Order\DAL\Order;

use App\DomainUtils\BaseDAL\BaseDALInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderDALInterface extends BaseDALInterface
{
    /**
     * Get order list by user id
     *
     * @param int $userId
     * @return LengthAwarePaginator
     */
    public function getListOrder(int $userId): LengthAwarePaginator;

    /**
     * Find order by uuid
     *
     * @param string $uuid
     * @return mixed
     */
    public function findOrderByUuid(string $uuid): mixed;
}
