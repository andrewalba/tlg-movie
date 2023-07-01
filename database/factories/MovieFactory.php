<?php

namespace Database\Factories;

use App\Contstants\Genres;
use App\Models\Cast;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->title($this->faker->numberBetween(1, 10));
        return [
            'title' => $title,
            'year' => $this->faker->year($max = 'now'),
            'score' => $this->faker->randomFloat(14, 1, 10),
            'rating' => $this->faker->numberBetween(1, 5),
            'genres' => Genres::random($this->faker->numberBetween(1,4)),
            'image' => 'https://placeholder.pics/svg/300x900/DEDEDE/555555/' . urlencode($title),
        ];
    }

    private function title($nbWords = 5)
    {
        $sentence = $this->faker->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }
}
