<?php

namespace App\Domain\Order\DTO\Payment;

use App\Domain\Order\Models\Payment;
use Dflydev\DotAccessData\Data;

class PaymentDTO extends Data
{
    public string $type;
    public object $details;

    public function __construct(
        string $type,
        array $details
    ) {
       $this->type = $type;

        if ($type === Payment::CREDIT_CARD) {
            $this->details = CreditCardDTO::from($details);
        }

        if ($type === Payment::CASH_ON_DELIVERY) {
            $this->details = CashOnDeliveryDTO::from($details);
        }

        if ($type === Payment::BANK_TRANSFER) {
            $this->details = BankTransferDTO::from($details);
        }
    }
}
