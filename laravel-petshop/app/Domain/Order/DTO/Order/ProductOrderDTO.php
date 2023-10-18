<?php

namespace App\Domain\Order\DTO\Order;

use Spatie\LaravelData\Data;

class ProductOrderDTO extends Data
{
    public function __construct(
        public string $uuid,
        public int $quantity
    ) {}
}
