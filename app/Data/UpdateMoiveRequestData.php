<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UpdateMoiveRequestData extends Data
{
    public function __construct(
        public ?string $title,
        public ?int $year,
        public ?float $score,
        public ?int $rating,
        public ?string $image,
    )
    {

    }
}
