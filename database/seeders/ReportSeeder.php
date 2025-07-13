<?php

namespace Database\Seeders;

use DB;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {           
            DB::table('reports')->insert([
                'date' => $faker->dateTimeBetween('-12 week', 'now'),
                'note' => $faker->paragraphs(2, true), // Generates a slug from the title
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(), // Current timestamp
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
}
