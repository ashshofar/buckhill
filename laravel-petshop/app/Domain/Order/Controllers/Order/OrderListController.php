<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/orders",
 *     summary="Get list order",
 *     tags={"Order"},
 *     security={{ "bearerAuth": {} }},
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
