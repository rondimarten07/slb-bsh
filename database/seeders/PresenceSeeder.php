<?php

namespace Database\Seeders;

use DB;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 20) as $index) {      
            DB::table('presences')->insert([
                'date' => $faker->dateTimeBetween('-12 week', 'now')->format('Y-m-d'),
                'note' => $faker->randomElement(['hadir', 'izin', 'sakit', 'alpa']),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => now(), // Current timestamps
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
}
