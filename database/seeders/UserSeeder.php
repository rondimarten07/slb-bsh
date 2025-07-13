<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@mail.com',
            'password' => '$2y$10$qmHHpCehp2iAePN473WIkeHN4luggbZT9EKzVU1kohjniPU9riGKe',
            'classroom' => null
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => '$2y$10$qmHHpCehp2iAePN473WIkeHN4luggbZT9EKzVU1kohjniPU9riGKe',
            'classroom' => null
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@mail.com',
            'password' => Hash::make('password'),
            'classroom' => null
        ]);
        $user->assignRole('staff');

        $user = User::factory()->create([
            'name' => 'Bendahara',
            'email' => 'bendahara@mail.com',
            'password' => Hash::make('password'),
            'classroom' => null
        ]);
        $user->assignRole(roles: 'treasurer');

        $user = User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@mail.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole('teacher');

        $user = User::factory()->create([
            'name' => 'Student',
            'email' => 'student@mail.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole('student');


        $students = User::factory()->count(20)->create();
        foreach ($students as $student) {
            $student->assignRole('student');
        }

        $teachers = User::factory()->count(10)->create();
        foreach ($teachers as $teacher) {
            $teacher->assignRole('teacher');
        }
        
        $staffs = User::factory()->count(3)->create();
        foreach ($staffs as $staff) {
            $staff->assignRole('staff');
        }

        
    }
}
