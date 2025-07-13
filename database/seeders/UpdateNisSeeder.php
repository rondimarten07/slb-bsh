<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UpdateNisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get student role
        $studentRole = Role::where('name', 'student')->first();
        
        if ($studentRole) {
            $students = User::whereHas('roles', function ($query) use ($studentRole) {
                $query->where('role_id', $studentRole->id);
            })->get();
            
            foreach ($students as $index => $student) {
                // Generate NIS if not exists
                if (!$student->nis) {
                    $nis = 'NIS' . str_pad($student->id, 4, '0', STR_PAD_LEFT);
                    $student->update(['nis' => $nis]);
                }
            }
        }
    }
} 