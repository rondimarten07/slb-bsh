<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'amount' => fake()->numberBetween(10000, 1000000),
            'direction' => fake()->randomElement(['IN', 'OUT']),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 