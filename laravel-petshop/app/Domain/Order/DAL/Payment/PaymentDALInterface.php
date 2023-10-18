<?php

namespace App\Domain\Order\DAL\Payment;

use App\Domain\Order\DTO\Payment\PaymentDTO;
use App\Domain\Order\Models\Payment;
use App\DomainUtils\BaseDAL\BaseDALInterface;

interface PaymentDALInterface extends BaseDALInterface
{
    /**
     * Create payment
     *
     * @param PaymentDTO $paymentDTO
     * @return Payment
     */
    public function createPayment(PaymentDTO $paymentDTO): Payment;

    /**
     * Find payment by Uuid
     *
     * @param string $uuid
     * @return Payment
     */
    public function findPaymentByUuid(string $uuid): Payment;
}
