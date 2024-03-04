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
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date,
            'location' => $this->faker->address,
            'availableSeats' => $this->faker->numberBetween(1, 100),
            'takenSeats' => $this->faker->numberBetween(0, 50),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'reservationMethod' => $this->faker->numberBetween(1, 3),
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
            'organizer_id' => function () {
                return \App\Models\Organizer::factory()->create()->id;
            },
        ];
    }
}
