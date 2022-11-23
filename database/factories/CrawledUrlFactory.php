<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CrawledUrl>
 */
class CrawledUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid'                  => fake()->uuid(),
            'url'                   => fake()->url(),
            'unique_images'         => fake()->randomNumber(1, 30),
            'unique_internal_links' => fake()->randomNumber(1, 30),
            'unique_external_links' => fake()->randomNumber(1, 30),
            'page_load'             => fake()->numberBetween(1, 60),
            'word_count'            => fake()->randomNumber(),
            'title_length'          => fake()->randomNumber(),
            'status_code'           => fake()->numberBetween(200, 599),
        ];
    }
}
