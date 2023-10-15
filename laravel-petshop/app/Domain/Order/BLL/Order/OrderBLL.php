<?php

namespace App\Domain\Order\BLL\Order;

use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use App\Domain\Order\DAL\Order\OrderDALInterface;

/**
 * @property OrderDALInterface DAL
 */
class OrderBLL extends BaseBLL implements OrderBLLInterface
{
    use BaseBLLFileUtils;

    public function __construct(OrderDALInterface $orderDAL)
    {
        $this->DAL = $orderDAL;
    }
}
