<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class StoreActorRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $name,
        #[IntegerType]
        public ?int $rating,
        public ?string $image_path,
        #[Max(255)]
        public ?string $alternative_name,
    )
    {

    }
}
