<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 10 random users
        // Movie::factory()->count(500)->create();
        $movies_json = File::get("database/data/movies.json");
        $movies = json_decode($movies_json);
        foreach ($movies as $movie)
        {
            $_movie = Movie::create([
                'title' => $movie->title,
                'year' => $movie->year,
                'score' => $movie->score,
                'rating' => $movie->rating,
                'genres' => $movie->genre,
                'image' => $movie->image,
            ]);
            if (count($movie->actors)) {
                foreach ($movie->actors as $name)
                {
                    if ($actor = Actor::where('name', $name)->first()) {
                        $_movie->actor()->attach($actor);
                    }
                }
            }
        }
    }
}
