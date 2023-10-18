<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Requests\OrderCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

class OrderCreateController extends Controller
{
    private OrderBLLInterface $orderBLL;

    public function __construct(OrderBLLInterface $orderBLL)
    {
        $this->orderBLL = $orderBLL;
    }

    /**
     * Create order
     *
     * @param OrderCreateRequest $request
     * @return ApiSuccessResponse
     */
    public function __invoke(OrderCreateRequest $request): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->orderBLL->createOrder(OrderDTO::from([...$request->all()])),
            'Order created'
        );

    }
}
