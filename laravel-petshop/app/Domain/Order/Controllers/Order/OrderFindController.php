<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Models\Order;
use App\Domain\Order\Requests\OrderCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

class OrderFindController extends Controller
{
    public function __construct(public OrderBLLInterface $orderBLL)
    {}

    /**
     * @param String $uuid
     * @return ApiSuccessResponse
     */
    public function __invoke(String $uuid): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->orderBLL->findOrderByUuid($uuid),
            'Order detail'
        );

    }
}
