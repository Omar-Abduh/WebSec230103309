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
        Permission::create(['name' => 'add_products', 'display_name' => 'Add Products']);
        Permission::create(['name' => 'edit_products', 'display_name' => 'Edit Products']);
        Permission::create(['name' => 'delete_products', 'display_name' => 'Delete Products']);
        Permission::create(['name' => 'show_users', 'display_name' => 'Show Users']);
        Permission::create(['name' => 'edit_users', 'display_name' => 'Edit Users']);
        Permission::create(['name' => 'delete_users', 'display_name' => 'Delete Users']);
        Permission::create(['name' => 'admin_users', 'display_name' => 'Admin Users']);
        Permission::create(['name' => 'add_users', 'display_name' => 'Add Users']);
        Permission::create(['name' => 'add_roles', 'display_name' => 'Add Roles']);
        Permission::create(['name' => 'add_permissions', 'display_name' => 'Add Permissions']);
        Permission::create(['name' => 'edit_roles', 'display_name' => 'Edit Roles']);
        Permission::create(['name' => 'edit_permissions', 'display_name' => 'Edit Permissions']);
        Permission::create(['name' => 'delete_roles', 'display_name' => 'Delete Roles']);
        Permission::create(['name' => 'delete_permissions', 'display_name' => 'Delete Permissions']);
        Permission::create(['name' => 'show_roles', 'display_name' => 'Show Roles']);
        Permission::create(['name' => 'show_permissions', 'display_name' => 'Show Permissions']);
        $role_admin->givePermissionTo(['add_products', 'edit_products', 'delete_products', 'show_users', 'edit_users', 'delete_users', 'admin_users', 'add_users']);

        $admin_user = User::find(1);
        $test_user = User::find(2);
        $admin_user->assignRole('Admin');
        $test_user->assignRole('Employee');

        // Direct Permissions
        $admin_user->givePermissionTo(['show_roles', 'show_permissions', 'add_roles', 'add_permissions', 'edit_roles', 'edit_permissions', 'delete_roles', 'delete_permissions']);
    }
}
