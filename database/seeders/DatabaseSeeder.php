<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (in_array(config('app.env'), ['local','dev'])) {
            $this->call([
                UserSeeder::class,
                ActorSeeder::class,
                MovieSeeder::class,
                //CastMovieSeeder::class,
            ]);
        }
    }
}
