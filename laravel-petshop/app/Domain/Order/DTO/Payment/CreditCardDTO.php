<?php

namespace App\Domain\Order\DTO\Payment;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreditCardDTO extends Data
{
    public function __construct(
        public string $holderName,
        public string $number,
        public int $ccv,
        public string $expireDate
    ) {}
}
