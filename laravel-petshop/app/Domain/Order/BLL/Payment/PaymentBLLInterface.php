<?php

namespace App\Domain\Order\BLL\Payment;

use App\Domain\Order\DTO\Payment\PaymentDTO;
use App\Domain\Order\Models\Payment;
use App\DomainUtils\BaseBLL\BaseBLLInterface;

interface PaymentBLLInterface extends BaseBLLInterface
{
    /**
     * Create payment
     *
     * @param PaymentDTO $paymentDTO
     * @return Payment
     */
    public function createPayment(PaymentDTO $paymentDTO): Payment;
}
