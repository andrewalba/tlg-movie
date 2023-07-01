<?php

namespace Database\Seeders;

use App\Contstants\Credits;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class ActorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::chunk(100, function($movies) {
            foreach ($movies as $movie)
            {
                foreach (Credits::array() as $name => $value) {
                    if ($value === 'Actor') {
                        $actors = Actor::inRandomOrder()->limit(random_int(3, 20))->get();
                        foreach ($actors as $actor)
                        {
                            $movie->cast()->attach($actor->id, ['credit' => $value]);
                        }
                    }
                    if ($value === 'Writer') {
                        $writers = Actor::inRandomOrder()->limit(random_int(1, 3))->get();
                        foreach ($writers as $writer)
                        {
                            $movie->cast()->attach($writer->id, ['credit' => $value]);
                        }
                    }
                    if ($value !== 'Actor' && $value !== 'Writer') {
                        $cast = Cast::inRandomOrder()->limit(1)->first();
                        $movie->cast()->attach($cast->id, ['credit' => $value]);
                    }
                }
            }
        });
    }
}
