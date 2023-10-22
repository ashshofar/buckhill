<?php

namespace App\Domain\Order\Controllers\Order;

use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Requests\OrderCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/order/create",
 *     summary="Create order",
 *     tags={"Order"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="order_status_uuid",
 *                      type="string",
 *                      example="6f00f183-c6a6-4e19-b5d2-c5b97965ec06"
 *                  ),
 *                  @OA\Property(
 *                      property="payment_uuid",
 *                      type="string",
 *                      example="74de88df-cb61-4b0b-9c5f-e748faae4c21"
 *                  ),
 *                  @OA\Property(
 *                      property="products",
 *                      type="object",
 *                      example={
 *                          {
 *                              "uuid": "d8d7280a-0591-4d0b-975e-d6be427db232",
 *                              "quantity": 1
 *                          },
 *                          {
 *                              "uuid": "9301291e-8c77-4c18-a064-0c0cb34e1ebb",
 *                              "quantity": 1
 *                          }
 *                     }
 *                  ),
 *                  @OA\Property(
 *                      property="address",
 *                      type="object",
 *                      example={
 *                          "billing": "billing",
 *                          "shipping": "shipping",
 *                      }
 *                  ),
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
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
