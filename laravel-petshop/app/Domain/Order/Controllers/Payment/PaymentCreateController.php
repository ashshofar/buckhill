<?php

namespace App\Domain\Order\Controllers\Payment;

use App\Domain\Order\BLL\Payment\PaymentBLLInterface;
use App\Domain\Order\DTO\Payment\PaymentDTO;
use App\Domain\Order\Requests\PaymentCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/payment/create",
 *     summary="Create payment",
 *     tags={"Payment"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="type",
 *                      type="string",
 *                      example="cash_on_delivery"
 *                  ),
 *                  @OA\Property(
 *                      property="details",
 *                      type="object",
 *                      example={
 *                          "first_name": "ikhsan",
 *                          "last_name": "nugraha",
 *                          "address": "Indonesia"
 *                      }
 *                  ),
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="OK"),
 *     @OA\Response(response=401, description="Unauthorized"),
 *     @OA\Response(response=422, description="Unprocessable Entity"),
 *     @OA\Response(response=404, description="Page not found"),
 *     @OA\Response(response=500, description="Internal server error")
 * )
 */
class PaymentCreateController extends Controller
{
    private PaymentBLLInterface $paymentBLL;

    public function __construct(PaymentBLLInterface $paymentBLL)
    {
        $this->paymentBLL = $paymentBLL;
    }

    /**
     * Create payment
     *
     * @param PaymentCreateRequest $request
     * @return ApiSuccessResponse
     */
    public function __invoke(PaymentCreateRequest $request): ApiSuccessResponse
    {
        $payment = new PaymentDTO(...$request->all());

        return new ApiSuccessResponse(
            $this->paymentBLL->createPayment($payment),
            'Payment created'
        );
    }
}
