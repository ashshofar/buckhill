<?php

namespace App\Domain\Order\DTO\Order;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class OrderDTO extends Data
{
    public function __construct(
//        public string|Optional $userUuid,
        public string $orderStatusUuid,
        public string $paymentUuid,
        public AddressOrderDTO $address,
        public array $products
    ) {
        $this->address = AddressOrderDTO::from($address);

        $tempProduct = [];
        foreach ($products as $product) {
            $tempProduct[] = ProductOrderDTO::from($product);
        }

        $this->products = $tempProduct;
    }
}
