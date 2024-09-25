<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->word,
            'location' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'organized_by' => $this->faker->word,
            'event_date' => $this->faker->date,

            'manager_id' => 1
        ];
    }
}