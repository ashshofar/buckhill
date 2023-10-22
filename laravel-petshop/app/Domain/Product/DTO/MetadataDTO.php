<?php

namespace App\Domain\Product\DTO;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class MetadataDTO extends Data
{
    public function __construct(
        public string $brand,
        public string $image
    ) {}
}
