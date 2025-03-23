<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{

    // Roles Logics

    public function roles_index()
    {
        $roles = Role::all();
        return view('permissions.roles_index', compact('roles'));
    }

    public function permissions_index()
    {
        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('permissions.permissions_index', compact('permissions', 'roles'));
    }

    public function roles_create()
    {
        return view('permissions.roles_create');
    }

    public function roles_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:50',
        ]);
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index');
    }

    public function roles_edit(Role $role)
    {
        return view('permissions.edit_role', compact('role'));
    }

    public function roles_update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
        ]);
        $role->update(['name' => $request->name]);
        return redirect()->route('roles.index');
    }

    public function roles_destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }

    // Permissions Logics 

    public function permissions_create()
    {
        return view('permissions.permissions_create');
    }

    public function permissions_store(Request $request)
    {
        $request->validate([
            'display_name' => 'required|string|unique:permissions,display_name|max:50',
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/_/', // Ensures that the string contains at least one underscore
                'unique:permissions,name'
            ],
        ]);
        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        return redirect()->route('permissions.index');
    }

    public function permissions_edit(Permission $permission)
    {
        return view('permissions.edit_permission', compact('permission'));
    }

    public function permissions_update(Request $request, Permission $permission)
    {
        
        $request->validate([
            'display_name' => 'required|string|max:50|unique:permissions,display_name,' . $permission->id,
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/_/',
                'unique:permissions,name,' . $permission->id
            ],
        ]);
        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        return redirect()->route('permissions.index');
    }

    public function permissions_destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
