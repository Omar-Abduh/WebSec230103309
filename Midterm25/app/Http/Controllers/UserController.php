<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
