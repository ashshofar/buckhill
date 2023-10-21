<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Auth\Access\AuthorizationException;

class OrderFindController extends Controller
{
    public function __construct(
        public AuthBLLInterface $authBLL,
        public OrderBLLInterface $orderBLL
    ) {}

    /**
     * @param String $uuid
     * @return ApiSuccessResponse
     * @throws AuthorizationException
     */
    public function __invoke(String $uuid): ApiSuccessResponse
    {
        $order = $this->orderBLL->findOrderByUuid($uuid);

        $this->authorize('viewOrder', $order);

        return new ApiSuccessResponse(
            $order,
            'Order detail'
        );

    }
}
