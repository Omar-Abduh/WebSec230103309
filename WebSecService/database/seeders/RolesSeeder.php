<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'Admin']);
        $role_employee = Role::create(['name' => 'Employee']);
        $permission_admin = Permission::create(['name' => 'add_products', 'display_name' => 'Add Products']);
        $permission_admin = Permission::create(['name' => 'edit_products', 'display_name' => 'Edit Products']);
        $permission_admin = Permission::create(['name' => 'delete_products', 'display_name' => 'Delete Products']);
        $permission_admin = Permission::create(['name' => 'show_users', 'display_name' => 'Show Users']);
        $permission_admin = Permission::create(['name' => 'edit_users', 'display_name' => 'Edit Users']);
        $permission_admin = Permission::create(['name' => 'delete_users', 'display_name' => 'Delete Users']);
        $permission_admin = Permission::create(['name' => 'admin_users', 'display_name' => 'Admin Users']);
        $permission_admin = Permission::create(['name' => 'add_users', 'display_name' => 'Add Users']);
        $role_admin->givePermissionTo(['add_products', 'edit_products', 'delete_products', 'show_users', 'edit_users', 'delete_users', 'admin_users', 'add_users']);

        $admin_user = User::find(1);
        $test_user = User::find(2);
        $admin_user->assignRole('Admin');
        $test_user->assignRole('Employee');
    }
}
