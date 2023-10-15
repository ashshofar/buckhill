<?php

namespace App\Domain\Order\DAL\Order;

use App\DomainUtils\BaseDAL\BaseDAL;
use App\Domain\Order\Models\Order;

/**
 * @property Order model
 */
class OrderDAL extends BaseDAL implements OrderDALInterface
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }
}
