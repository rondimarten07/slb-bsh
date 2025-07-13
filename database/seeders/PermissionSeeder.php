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
        Permission::create(['name' => 'manage-user']);
        Permission::create(['name' => 'manage-article']);
        Permission::create(['name' => 'manage-student']);
        Permission::create(['name' => 'manage-library']);
        Permission::create(['name' => 'manage-financial']);
        Permission::create(['name' => 'manage-config']);

        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo('manage-user');
        $role->givePermissionTo('manage-article');
        $role->givePermissionTo('manage-student');
        $role->givePermissionTo('manage-library');
        $role->givePermissionTo('manage-financial');
        
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('manage-article');
        $role->givePermissionTo('manage-student');
        $role->givePermissionTo('manage-library');
        $role->givePermissionTo('manage-financial');

        $role = Role::create(['name' => 'staff']);
        $role = Role::create(['name' => 'treasurer']);
        $role = Role::create(['name' => 'teacher']);
        $role = Role::create(['name' => 'student']);

    }
}
