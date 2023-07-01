<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'rating' => $this->faker->numberBetween(1,5),
            'image_path' => 'https://placeholder.pics/svg/300x900/DEDEDE/555555/' . urlencode($name),
            'alternative_name' => $this->faker->optional($weight = 0.7, $default = null)->name()
        ];
    }
}
