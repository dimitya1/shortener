<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Statistic;
use App\Models\User;
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
        User::factory(30)->create()->each (function ($user) {
            Link::factory()->count(rand(1, 4))->create(['user_id' => $user->id])->each (function ($link) use ($user) {
                Statistic::factory()->count(rand(2, 20))->create(['user_id' => null]);
            });
        });
    }
}
