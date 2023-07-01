<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UpdateActorRequestData extends Data
{
    public function __construct(
        public ?string $name,
        public ?int $rating,
        public ?string $image_path,
        public ?string $alternative_name,
    )
    {

    }
}
