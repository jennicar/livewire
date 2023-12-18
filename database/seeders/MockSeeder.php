<?php

namespace Database\Seeders;

use Database\Seeders\Mock\BlogSeeder;
use Illuminate\Database\Seeder;

class MockSeeder extends Seeder
{
    public function run()
    {
        $seeders = collect([
            BlogSeeder::class,
        ]);

        $seeders->each(fn($seeder) => $this->call($seeder));
    }
}
