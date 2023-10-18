<?php

namespace App\Domain\Order\DAL\Payment;

use App\Domain\Order\DTO\PaymentDTO;
use App\Domain\Order\Models\Payment;
use App\DomainUtils\BaseDAL\BaseDAL;

/**
 * @property Payment model
 */
class PaymentDAL extends BaseDAL implements PaymentDALInterface
{
    public function __construct(Payment $payment)
    {
        $this->model = $payment;
    }

    /**
     * Create payment
     *
     * @param PaymentDTO $paymentDTO
     * @return Payment
     */
    public function createPayment(PaymentDTO $paymentDTO): Payment
    {
        $payment = new Payment();
        $payment->type = $paymentDTO->type;
        $payment->details = json_encode($paymentDTO->details);
        $payment->save();
        return $payment;
    }
}
