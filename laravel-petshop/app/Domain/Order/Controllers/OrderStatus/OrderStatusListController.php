<?php

namespace App\Domain\Order\Controllers\OrderStatus;

use App\Domain\Order\BLL\OrderStatus\OrderStatusBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/order-statuses",
 *     summary="Get order status",
 *     tags={"Order Status"},
 *    @OA\Parameter(
 *          name="limit",
 *          in="query",
 *          description="item limit",
 *          required=false,
 *          @OA\Schema(type="integer")
 *    ),
 *    @OA\Parameter(
 *         name="desc",
 *         in="query",
 *         description="desc",
 *         required=false,
 *         @OA\Schema(type="boolean")
 *     ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
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
