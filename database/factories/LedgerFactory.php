<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ledger>
 */
class LedgerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'amount' => fake()->numberBetween(1000, 1000000),
            'direction' => fake()->randomElement(['IN', 'OUT']),
            'date' => fake()->dateTime($max = 'now')
        ];
    }
}
