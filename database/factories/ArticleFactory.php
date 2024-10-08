<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=> $this->faker->word,
            "content"=> $this->faker->word,
            "image"=> $this->faker->imageUrl,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
                        
        ];
    }
}