<?php

namespace Database\Seeders;

use DB;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 5) as $index) {
            $title = $faker->sentence(6); // Generates a random title with 6 words
            
            DB::table('posts')->insert([
                'title' => $title,
                'slug' => Str::slug($title, '-'), // Generates a slug from the title
                'cover' => 'uploads/no-image.jpg',
                'content' => $faker->paragraphs(5, true), // Generates 5 paragraphs of random text
                'created_at' => now(), // Current timestamp
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
}
