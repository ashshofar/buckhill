<?php

namespace App\Domain\Order\DTO\Order;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AddressOrderDTO extends Data
{
    public function __construct(
        public string $billing,
        public string $shipping
    ) {}
}
