<?php

namespace App\Domain\Order\Controllers\Payment;

use App\Domain\Order\BLL\Payment\PaymentBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

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
