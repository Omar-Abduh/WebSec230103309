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
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('show_roles')) abort(401);
        }

        $roles = Role::all();
        return view('permissions.roles_index', compact('roles'));
    }

    public function roles_create()
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('add_roles')) abort(401);
        }
        return view('permissions.roles_create');
    }

    public function roles_store(Request $request)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('add_roles')) abort(401);
        }
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:50',
        ]);
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index');
    }

    public function roles_edit(Role $role)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('edit_roles')) abort(401);
        }
        return view('permissions.edit_role', compact('role'));
    }

    public function roles_update(Request $request, Role $role)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('edit_roles')) abort(401);
        }
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
        ]);
        $role->update(['name' => $request->name]);
        return redirect()->route('roles.index');
    }

    public function roles_destroy(Role $role)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('delete_roles')) abort(401);
        }
        $role->delete();
        return redirect()->route('roles.index');
    }

    // Give permission to role
    public function give_permissions(Role $role)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('give_permission')) abort(401);
        }
        $permissions = Permission::all();
        return view('permissions.give_permissions', compact('role', 'permissions'));
    }

    public function add_permission_to_role(Request $request, Role $role)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('give_permission')) abort(401);
        }
        $permission = Permission::find($request->permission_id);
        if ($permission) {
            $role->givePermissionTo($permission);
        }
        return response()->json(['success' => true]);
    }

    public function remove_permission_from_role(Request $request, Role $role)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('give_permission')) abort(401);
        }
        $permission = Permission::find($request->permission_id);
        if ($permission) {
            $role->revokePermissionTo($permission);
        }
        return response()->json(['success' => true]);
    }

    // Permissions Logics 

    public function permissions_index()
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('show_permissions')) abort(401);
        }
        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('permissions.permissions_index', compact('permissions', 'roles'));
    }

    public function permissions_create()
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('add_permissions')) abort(401);
        }
        return view('permissions.permissions_create');
    }

    public function permissions_store(Request $request)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('add_permissions')) abort(401);
        }
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
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('edit_permissions')) abort(401);
        }
        return view('permissions.edit_permission', compact('permission'));
    }

    public function permissions_update(Request $request, Permission $permission)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('edit_permissions')) abort(401);
        }
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
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('delete_permissions')) abort(401);
        }
        $permission->delete();
        return redirect()->route('permissions.index');
    }

    // Assign Role to Permissions
    public function assign_role(Permission $permissions)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('assign_role')) abort(401);
        }
        $roles = Role::all();
        $selectedRoles = $permissions->roles;
        return view('permissions.assign_role', compact('roles', 'permissions', 'selectedRoles'));
    }

    public function store_role_assignment(Request $request, Permission $permission)
    {
        if (auth()->user()->hasRole(['Admin', 'Super Admin'])) {
            if (!auth()->user()->hasPermissionTo('assign_role')) abort(401);
        }
        $request->validate([
            'role_id' => 'nullable|exists:roles,id',
        ]);

        if ($request->role_id) {
            $role = Role::find($request->role_id);
            if ($role) {
                $permission->assignRole($role);
            }
        } else {
            // Remove all roles from the permission if "No Role" is selected
            $permission->roles()->detach();
        }

        return redirect()->route('permissions.index');
    }
}
