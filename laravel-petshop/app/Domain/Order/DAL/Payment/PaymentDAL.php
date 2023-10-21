<?php

namespace App\Domain\Order\DAL\Payment;

use App\Domain\Order\DTO\Payment\PaymentDTO;
use App\Domain\Order\Models\Payment;
use App\DomainUtils\BaseDAL\BaseDAL;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * Get list payment
     *
     * @return LengthAwarePaginator
     */
    public function getListPayments(): LengthAwarePaginator
    {
        $limit = request('limit');
        $desc = request('desc');

        $payments = $this->model->query();

        if ($desc) {
            $payments->orderBy('created_at', 'DESC');
        } else {
            $payments->orderBy('created_at', 'ASC');
        }

        return $payments->paginate($limit);
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


    /**
     * Find payment by Uuid
     *
     * @param string $uuid
     * @return Payment
     */
    public function findPaymentByUuid(string $uuid): Payment
    {
        return $this->model->where('uuid', $uuid)->firstOrFail();
    }
}
