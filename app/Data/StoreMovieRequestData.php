<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Data;

class StoreMovieRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $title,
        #[DateFormat('Y')]
        public int $year,
        #[Numeric]
        public ?float $score,
        #[IntegerType]
        public ?int $rating,
        public ?string $image,
    )
    {

    }

}
