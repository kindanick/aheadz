<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'species' => fake()->word,
            'name' => fake()->firstName,
            'age' => fake()->numberBetween(1, 20),
            'description' => fake()->sentence,
            'cage_id' => \App\Models\Cage::factory(),
            'created_by' => \App\Models\User::factory()
        ];
    }
}
