<?php

namespace App\Domain\Order\Controllers\OrderStatus;

use App\Domain\Order\BLL\OrderStatus\OrderStatusBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

class OrderStatusListController extends Controller
{
    public function __construct(public OrderStatusBLLInterface $orderStatusBLL)
    {}

    /**
     * Get list order statuses
     *
     * @return ApiSuccessResponse
     */
    public function __invoke(): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->orderStatusBLL->getListStatuses(),
            'List Statuses'
        );
    }
}
