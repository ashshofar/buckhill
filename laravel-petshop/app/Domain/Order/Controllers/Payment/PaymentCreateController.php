<?php

namespace App\Domain\Order\Controllers\Payment;

use App\Domain\Order\BLL\Payment\PaymentBLLInterface;
use App\Domain\Order\DTO\PaymentDTO;
use App\Domain\Order\Requests\PaymentCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

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
