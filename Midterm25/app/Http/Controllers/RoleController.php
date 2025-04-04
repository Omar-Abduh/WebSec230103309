<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(8);
        $roles_total = Role::all();
        return view('admin.role.index', compact('roles', 'roles_total'));
    }

    public function show()
    {
        $roles = Role::all();

        return view('admin.role.show', compact('roles'));
    }
    
    // Create role
    public function create(){
        $roles = Role::all();
        return view('admin.role.create', compact('roles'));
    }

    // Store role
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('role.index')->with([
            'success' => 'Role created successfully.',
            'success_description' => 'The role has been added to the system.'
        ]);
    }

    // Edit role
    public function edit(Role $role){
        return view('admin.role.edit', compact('role'));
    }

    // Update role
    public function update(Request $request, Role $role){
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('role.index')->with([
            'success' => 'Role updated successfully.',
            'success_description' => 'The role details have been updated.'
        ]);
    }

    // Assign permissions to role
    public function permissions(Role $role){
        $permissions = $role->permissions()->paginate(8); // Paginate permissions
        $permissions_total = Permission::whereNotIn('name', $role->permissions->pluck('name'))->get(); // Get unassigned permissions
        return view('admin.role.permissions', compact('role', 'permissions', 'permissions_total'));
    }

    // Remove permissions from role
    public function remove_permissions(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission); // Detach the permission from the role
        return redirect()->back()->with([
            'success' => 'Permission removed successfully.',
            'success_description' => 'The permission has been removed from the role.'
        ]);
    }

    // Assign permissions to role
    public function assign_permissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|string'
        ]);

        // Convert comma-separated string to array
        $permissionNames = explode(',', $request->permissions);
        
        // Assign each permission by name
        foreach ($permissionNames as $permissionName) {
            $role->givePermissionTo(trim($permissionName)); // trim to remove any whitespace
        }

        return redirect()->back()->with([
            'success' => 'Permissions assigned successfully.',
            'success_description' => 'The selected permissions have been assigned to the role.'
        ]);
    }

    // Delete role
    public function destroy(Role $role){
        $role->delete();
        return redirect()->back()->with([
            'success' => 'Role deleted successfully.',
            'success_description' => 'The role has been removed from the system.'
        ]);
    }
}
