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
    Route::get('/roles/show', [RoleController::class, 'show'])->name('role.show');
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

    // Assign permissions to roles
    Route::get('/role/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions');
    Route::delete('/role/{role}/{permission}/permissions', [RoleController::class, 'remove_permissions'])->name('role.permissions.remove');
    Route::post('/role/{role}/permissions-assign', [RoleController::class, 'assign_permissions'])->name('role.permissions.assign');
});

// Admin & Employee routes
Route::middleware(['auth', 'admin_or_employee'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/show', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user}/permissions', [UserController::class, 'permissions'])->name('user.permissions');
    Route::post('/user/{user}/permissions-assign', [UserController::class, 'assignDirectPermissions'])->name('user.direct.permissions.assign');
    Route::delete('/user/{user}/{permission}/permissions', [UserController::class, 'removePermission'])->name('user.permissions.remove');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{user}/edit', [UserController::class, 'update'])->name('user.update');
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
