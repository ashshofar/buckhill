<?php

namespace App\Domain\Order\DTO\Payment;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class BankTransferDTO extends Data
{
    public function __construct(
        public string $swift,
        public string $iban,
        public string $name
    ) {}
}
