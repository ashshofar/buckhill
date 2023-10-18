<?php

namespace App\Domain\Order\BLL\Payment;

use App\Domain\Order\DAL\Payment\PaymentDALInterface;
use App\Domain\Order\DTO\Payment\PaymentDTO;
use App\Domain\Order\Models\Payment;
use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;

/**
 * @property PaymentDALInterface DAL
 */
class PaymentBLL extends BaseBLL implements PaymentBLLInterface
{
    use BaseBLLFileUtils;

    public function __construct(PaymentDALInterface $paymentDAL)
    {
        $this->DAL = $paymentDAL;
    }

    /**
     * Create payment
     *
     * @param PaymentDTO $paymentDTO
     * @return Payment
     */
    public function createPayment(PaymentDTO $paymentDTO): Payment
    {
        return $this->DAL->createPayment($paymentDTO);
    }
}
