<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CrawledUrl;
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
        // \App\Models\User::factory(10)->create();

        # Super duper bad, don't do this!
         User::factory()->create([
             'name'     => 'Test User',
             'email'    => 'reDPotato55',
             'password' => '$2a$12$w.79rpzE3anAGW6KbUZU1uLHj/mKUwQG2nSdX1n9XBe/VmrvFofA2'
         ]);
    }
}
