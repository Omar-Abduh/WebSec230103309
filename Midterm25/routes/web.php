<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user && $user->hasRole('Admin')) {
        return view('admin.dashboard');
    }
    if ($user && $user->hasRole('Employee')) {
        return view('dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/create', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::patch('/role/edit/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('role.delete');
    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permissions/show', [PermissionController::class, 'show'])->name('permission.show');
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission/create', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/edit/{permission}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::patch('/permission/edit/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permission.delete');
});

// Admin & Employee routes
Route::middleware(['auth', 'admin_or_employee'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/show', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/edit/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.delete');

    // Access Control Panel
    Route::get('/access-control-panel', function () {
        $roles = count(Role::all());
        $permissions = count(Permission::all());
        $users = count(User::all());
        return view('access-control-panel', compact('roles', 'permissions', 'users'));
    })->name('access-control-panel');
});

// Auth routes
require __DIR__ . '/auth.php';
