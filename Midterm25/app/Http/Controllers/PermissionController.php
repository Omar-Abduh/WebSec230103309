<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(8);
        $permissions_total = Permission::all();

        return view('admin.permissions.index', compact('permissions', 'permissions_total'));
    }
    
    public function show()
    {
        $permissions = Permission::all();

        return view('admin.permissions.show', compact('permissions'));
    }

    // Create permission
    public function create()
    {
        $roles = Role::all();
        return view('admin.permissions.create', compact('roles'));
    }

    // Store permission
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        // if ($request->role) {

        // }
        if (is_array($request->role)) {
            $permission->syncRoles($request->role);
        }

        return redirect()->route('permission.index')->with([
            'success' => 'Permission created successfully.',
            'success_description' => 'The permission has been added to the system.'
        ]);
    }

    // Edit permission
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    // Update permission
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        if (is_array($request->role)) {
            $permission->syncRoles($request->role);
        }

        return redirect()->route('permission.index')->with([
            'success' => 'Permission updated successfully.',
            'success_description' => 'The permission details have been updated.'
        ]);
    }

    // Delete permission
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->back()->with([
            'success' => 'permission deleted successfully.',
            'success_description' => 'The permission has been removed from the system.'
        ]);
    }
}
