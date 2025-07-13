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
        $superadmin = User::firstOrCreate(['email' => 'superadmin@mail.com'], [
            'name' => 'SuperAdmin',
            'password' => '$2y$10$qmHHpCehp2iAePN473WIkeHN4luggbZT9EKzVU1kohjniPU9riGKe',
            'classroom' => null
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::firstOrCreate(['email' => 'admin@mail.com'], [
            'name' => 'Admin',
            'password' => '$2y$10$qmHHpCehp2iAePN473WIkeHN4luggbZT9EKzVU1kohjniPU9riGKe',
            'classroom' => null
        ]);
        $admin->assignRole('admin');

        $user = User::firstOrCreate(['email' => 'staff@mail.com'], [
            'name' => 'Staff',
            'password' => Hash::make('password'),
            'classroom' => null
        ]);
        $user->assignRole('staff');

        $user = User::firstOrCreate(['email' => 'bendahara@mail.com'], [
            'name' => 'Bendahara',
            'password' => Hash::make('password'),
            'classroom' => null
        ]);
        $user->assignRole(roles: 'treasurer');

        $user = User::firstOrCreate(['email' => 'teacher@mail.com'], [
            'name' => 'Teacher',
            'password' => Hash::make('password')
        ]);
        $user->assignRole('teacher');

        $user = User::firstOrCreate(['email' => 'student@mail.com'], [
            'name' => 'Student',
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
