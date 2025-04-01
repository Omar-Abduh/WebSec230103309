<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin_role = Role::create(['name' => 'Admin']);
        $employee_role = Role::create(['name' => 'Employee']);
        $customer_role = Role::create(['name' => 'Customer']);

        // Create permissions
        // Admin permissions
        Permission::create(['name' => 'Show Roles']);
        Permission::create(['name' => 'Create Roles']);
        Permission::create(['name' => 'Edit Roles']);
        Permission::create(['name' => 'Remove Roles']);
        Permission::create(['name' => 'Create Permissions']);
        Permission::create(['name' => 'Show Permissions']);
        Permission::create(['name' => 'Edit Permissions']);
        Permission::create(['name' => 'Remove Permissions']);
        Permission::create(['name' => 'Create Employees']);
        Permission::create(['name' => 'Show Employees']);
        Permission::create(['name' => 'Edit Employees']);
        Permission::create(['name' => 'Remove Employees']);
        Permission::create(['name' => 'Create Customers']);
        Permission::create(['name' => 'Edit Customers']);
        Permission::create(['name' => 'Remove Customers']);
        Permission::create(['name' => 'Remove Credits']);
        Permission::create(['name' => 'Edit Credits']);
        // Admin and Employee permissions
        Permission::create(['name' => 'Show Customers']);
        Permission::create(['name' => 'Create Products']);
        Permission::create(['name' => 'Show Products']);
        Permission::create(['name' => 'Edit Products']);
        Permission::create(['name' => 'Limit Products']);
        Permission::create(['name' => 'Remove Products']);
        Permission::create(['name' => 'Charge Credits']);
        Permission::create(['name' => 'Show Credits']);
        Permission::create(['name' => 'Edit Credits positive only']);

        // Assign Role to permissions
        $admin_role->syncPermissions(
            'Show Roles',
            'Create Roles',
            'Edit Roles',
            'Remove Roles',
            'Create Permissions',
            'Show Permissions',
            'Edit Permissions',
            'Remove Permissions',
            'Create Employees',
            'Show Employees',
            'Edit Employees',
            'Remove Employees',
            'Create Customers',
            'Show Customers',
            'Edit Customers',
            'Remove Customers',
            'Charge Credits',
            'Show Credits',
            'Edit Credits',
            'Remove Credits',
            'Create Products',
            'Show Products',
            'Edit Products',
            'Remove Products',
            'Limit Products'

        );
        $employee_role->syncPermissions(
            'Show Customers',
            'Create Products',
            'Show Products',
            'Edit Products',
            'Limit Products',
            'Remove Products',
            'Charge Credits',
            'Show Credits',
            'Edit Credits positive only'
        );
        $customer_role->syncPermissions('Show Products', 'Show Credits');
    }
}
