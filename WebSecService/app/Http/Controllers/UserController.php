<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ValidatesRequests;

    // Authentication methods
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return redirect()->back()->withInput($request->input())->withErrors('Invalid login information.');

        $user = User::where('email', $request->email)->first();
        Auth::setUser($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Invalid registration information.');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    // User profile method in UserController
    public function profile(Request $request, User $user)
    {
        // Fetch roles with permissions only for 'Super Admin' and 'Admin'
        $roles = Role::whereIn('name', ['Super Admin', 'Admin'])->with('permissions')->get();

        // Get permission names for 'Super Admin' and 'Admin'
        $superAdminPermissions = $roles->where('name', 'Super Admin')->first()?->permissions->pluck('name')->toArray() ?? [];
        $adminPermissions = $roles->where('name', 'Admin')->first()?->permissions->pluck('name')->toArray() ?? [];

        // Fetch all user permissions
        $userPermissions = $user->getAllPermissions()->map(function ($permission) use ($superAdminPermissions, $adminPermissions) {
            return [
                'name' => $permission->name,
                'display_name' => $permission->display_name ?? $permission->name,
                'color' => in_array($permission->name, $superAdminPermissions) ? 'bg-dark' : (in_array($permission->name, $adminPermissions) ? 'bg-danger' : 'bg-primary')
            ];
        });

        return view('users.profile', compact('user', 'userPermissions'));
    }

    public function edit(User $user)
    {
        if (auth()->id() !== $user->id) {
            if (!auth()->user()->hasPermissionTo('edit_users')) abort(401);
        }
        return view('users.edit', compact('user'));
    }

    public function edit_pass(User $user)
    {
        if (auth()->id() !== $user->id) {
            if (!auth()->user()->hasPermissionTo('edit_users')) abort(401);
        }
        return view('users.change_pass', compact('user'));
    }

    public function savePass(Request $request, User $user)
    {
        if (auth()->id() == $user->id) {

            $request->validate([
                'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()]
            ]);

            if (Hash::check($request->old_password, $user->password)) {
                if ($request->old_password === $request->password) {
                    return back()->withErrors('New password cannot be the same as the old password.');
                }
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->route('users.profile', ['user' => $user->id]);
            } else {
                return back()->withErrors('Old password is incorrect.');
            }
        } elseif (!auth()->user()->hasPermissionTo('edit_users')) abort(401);

        $user->password = bcrypt($request->password); //Secure
        $user->save();
        return redirect()->route('users.index');
    }

    // Resource methods
    public function index()
    {
        if (!auth()->user()->hasPermissionTo('show_users')) abort(401);
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->hasPermissionTo('add_users')) abort(401);
        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {

        if (!auth()->user()->hasPermissionTo('add_users')) abort(401);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Ensure password is always set
        $user->save();

        return redirect()->route('users.index');
    }

    public function update(Request $request, User $user)
    {
        // dd($request->all());
        if (auth()->id() !== $user->id) {
            if (!auth()->user()->hasPermissionTo('edit_users')) abort(401);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if (auth()->id() !== $user->id) {
            return redirect()->route('users.index');
        }
        return redirect()->route('users.profile', compact('user'));
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->hasPermissionTo('delete_users')) abort(401);
        $user->delete();
        return redirect()->route('users.index');
    }
}
