<?php

namespace App\Domain\Order\Controllers\Payment;

use App\Domain\Order\BLL\Payment\PaymentBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/payments",
 *     summary="Get list payments",
 *     tags={"Payment"},
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
 *     @OA\Response(response=200, description="OK"),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=422, description="Unprocessable Entity"),
 *     @OA\Response(response=404, description="Page not found"),
 *     @OA\Response(response=500, description="Internal server error")
 * )
 */
class PaymentListController extends Controller
{
    public function __construct(public PaymentBLLInterface $paymentBLL)
    {}

    public function __invoke()
    {
        return new ApiSuccessResponse(
            $this->paymentBLL->getListPayments(),
            'Payment List'
        );
    }
}
