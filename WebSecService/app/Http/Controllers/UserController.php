<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    use ValidatesRequests;
    // Login function
    public function login()
    {
        return view('auth.login');
    }

    public function profile(Request $request, User $user)
    {
        return view('users.profile', compact('user'));
    }

    // Do Login  function
    public function doLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return redirect()->back()->withInput($request->input())->withErrors('Invalid login information.');

        $user = User::where('email', $request->email)->first();
        Auth::setUser($user);

        return redirect()->route('home');
    }

    //  register function
    public function register()
    {
        return view('auth.register');
    }

    //  register function
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

    //  logout function
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('users.create', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Ensure password is always set
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',    
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'old_password' => 'nullable|string',
            'password' => 'nullable|string|confirmed|different:old_password',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('old_password') && $request->filled('password')) {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->old_password === $request->password) {
                    return redirect()->back()->withErrors('New password cannot be the same as the old password.');
                }
                $user->password = bcrypt($request->password);
            } else {
                return redirect()->back()->withErrors('Old password is incorrect.');
            }
        }

        $user->save();

        return redirect()->route('users.profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
