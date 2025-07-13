<?php

namespace Database\Seeders;

use DB;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 50) as $index) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3), // Generates a random title with 3 words
                'author' => $faker->name, // Generates a random author name
                'publisher' => $faker->name, // Generates a random publisher name
                'year' => $faker->date('Y'), // Generates a random published year
                'pages' => $faker->numberBetween(50, 500), // Random number between 50 and 500
                'created_at' => now(), // Current timestamp
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
}
