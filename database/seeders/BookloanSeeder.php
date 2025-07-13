<?php

namespace Database\Seeders;

use DB;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookloanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Get all book IDs to use them as foreign keys
        $bookIds = DB::table('books')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            $startDate = $faker->dateTimeBetween('-1 year', 'now'); // Random start date within the past year
            $endDate = $faker->dateTimeBetween($startDate, '+1 month'); // Random end date after the start date within a month

            DB::table('bookloans')->insert([
                'start_date' => $startDate->format('Y-m-d'), // Format start date as Y-m-d
                'end_date' => $endDate->format('Y-m-d'), // Format end date as Y-m-d
                'returned' => $faker->boolean(30),
                'book_id' => $faker->randomElement($bookIds), // Randomly assign a book_id from existing books
                'user_id' => $faker->randomElement($userIds), // Random user ID
                'created_at' => now(), // Current timestamp
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
}
