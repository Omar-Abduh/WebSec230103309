<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(8);
        $users_total = User::all();
        return view('users.index', compact('users', 'users_total'));
    }

    public function show()
    {
        $users = User::all();

        return view('users.show', compact('users'));
    }

    // Create user
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Store user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'exists:roles,name|nullable',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (!is_null($request->has('role')) ) {
            $user->assignRole($request->role);
        }

        return redirect()->route('user.index')->with([
            'success' => 'User created successfully.',
            'success_description' => 'The user has been added to the system.'
        ]);
    }

    // Edit user
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Update user
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'role' => 'exists:roles,name|nullable',
        ]);

        if ($request->has('password')) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        // Sync roles correctly
        // If the role is null, detach all roles
        // If the role is not null, sync the roles
        if (is_null($request->role)) {
            $user->roles()->detach(); 
        } else {
            $user->syncRoles($request->role);
        }

        return redirect()->route('user.index')->with([
            'success' => 'User updated successfully.',
            'success_description' => 'The user details have been updated.'
        ]);
    }
    
    public function permissions(User $user)
    {
        $permissions_total = Permission::whereNotIn('name', $user->getAllPermissions()->pluck('name'))->get();
        $permissions = Permission::whereIn('name', $user->getAllPermissions()->pluck('name'))->paginate(8);
        return view('users.permissions', compact('user', 'permissions_total', 'permissions'));
    }

    public function assignDirectPermissions(Request $request, User $user)
    {
        $request->validate([
            'permissions' => 'required|string'
        ]);
        
        // Convert comma-separated string to array
        $permissionNames = explode(',', $request->permissions);

        // Assign each permission by name
        foreach ($permissionNames as $permissionName) {
            $user->givePermissionTo(trim($permissionName)); // trim to remove any whitespace
        }

        return redirect()->route('user.permissions', $user->id)->with([
            'success' => 'Permissions assigned successfully.',
            'success_description' => 'The selected permissions have been assigned to the user.'
        ]);
    }
    
    public function removePermission(User $user, Permission $permission)
    {
        // Check if any of the user's roles have this permission
        foreach ($user->roles as $role) {
            if ($role->hasPermissionTo($permission)) {
                return redirect()->route('user.permissions', $user->id)->with([
                    'error' => 'Permission cannot be removed.',
                    'error_description' => 'The permission is associated with one of the '.$role->name.'\'s roles.'
                ]);
            }
        }

        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return redirect()->route('user.permissions', $user->id)->with([
                'success' => 'Permission removed successfully.',
                'success_description' => 'The selected permission has been removed from the user.'
            ]);
        }

        return redirect()->route('user.permissions', $user->id)->with([
            'error' => 'Permission not found.',
            'error_description' => 'The user does not have the specified permission.'
        ]);
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with([
            'success' => 'User deleted successfully.',
            'success_description' => 'The user has been removed from the system.'
        ]);
    }
}
