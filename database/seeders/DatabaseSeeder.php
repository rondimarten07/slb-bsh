<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            BookSeeder::class,
            BookloanSeeder::class,
            ReportSeeder::class,
            LedgerSeeder::class,
            PresenceSeeder::class
        ]);
    }
}
