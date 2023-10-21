<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Auth\Access\AuthorizationException;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/order/{uuid}",
 *     summary="Find order",
 *     tags={"Order"},
 *     security={{ "bearerAuth": {} }},
 *    @OA\Parameter(
 *          name="uuid",
 *          in="path",
 *          description="item uuid",
 *          required=true,
 *          @OA\Schema(type="string")
 *    ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
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
