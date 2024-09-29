<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announce>
 */
class AnnounceFactory extends Factory
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
            "description"=> $this->faker->word,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'category' => $this->faker->word,
            "status"=> $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            "image"=> $this->faker->imageUrl,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}