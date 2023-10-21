<?php

namespace App\Domain\Order\BLL\Payment;

use App\Domain\Order\DTO\Payment\PaymentDTO;
use App\Domain\Order\Models\Payment;
use App\DomainUtils\BaseBLL\BaseBLLInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface PaymentBLLInterface extends BaseBLLInterface
{
    /**
     * Get list payment
     *
     * @return LengthAwarePaginator
     */
    public function getListPayments(): LengthAwarePaginator;

    /**
     * Create payment
     *
     * @param PaymentDTO $paymentDTO
     * @return Payment
     */
    public function createPayment(PaymentDTO $paymentDTO): Payment;
}
