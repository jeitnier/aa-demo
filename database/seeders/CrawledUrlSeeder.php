<?php

namespace Database\Seeders;

use App\Models\CrawledUrl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrawledUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CrawledUrl::factory()->count(10)->create();
    }
}
