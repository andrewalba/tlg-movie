<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 1000 cast
        // Cast::factory()->count(5000)->create();
        $actors_json = File::get("database/data/actors.json");
        $actors = json_decode($actors_json);
        foreach ($actors as $actor)
        {
            // dd($actor);
            Actor::create([
                'name' => $actor->name,
                'rating' => $actor->rating,
                'image_path' => $actor->image_path,
                'alternative_name' => $actor->alternative_name ?? null,
            ]);
        }
    }
}
