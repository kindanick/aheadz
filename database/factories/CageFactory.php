<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cage>
 */
class CageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sign' => 'Cage-' . fake()->unique()->numberBetween(1, 100),
            'capacity' => fake()->numberBetween(1, 10),
        ];
    }
}
