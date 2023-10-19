<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

class OrderListController extends Controller
{
    private OrderBLLInterface $orderBLL;

    public function __construct(OrderBLLInterface $orderBLL)
    {
        $this->orderBLL = $orderBLL;
    }

    /**
     * Create order
     *
     * @return ApiSuccessResponse
     */
    public function __invoke(): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->orderBLL->getListOrders(),
            'Order list'
        );

    }
}
