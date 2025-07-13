<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::firstOrCreate(['name' => 'manage-user']);
        Permission::firstOrCreate(['name' => 'manage-article']);
        Permission::firstOrCreate(['name' => 'manage-student']);
        Permission::firstOrCreate(['name' => 'manage-library']);
        Permission::firstOrCreate(['name' => 'manage-financial']);
        Permission::firstOrCreate(['name' => 'manage-config']);

        $role = Role::firstOrCreate(['name' => 'superadmin']);
        $role->givePermissionTo('manage-user');
        $role->givePermissionTo('manage-article');
        $role->givePermissionTo('manage-student');
        $role->givePermissionTo('manage-library');
        $role->givePermissionTo('manage-financial');
        
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo('manage-article');
        $role->givePermissionTo('manage-student');
        $role->givePermissionTo('manage-library');
        $role->givePermissionTo('manage-financial');

        $role = Role::firstOrCreate(['name' => 'staff']);
        $role = Role::firstOrCreate(['name' => 'treasurer']);
        $role = Role::firstOrCreate(['name' => 'teacher']);
        $role = Role::firstOrCreate(['name' => 'student']);

    }
}
