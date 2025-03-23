<?php

use App\Http\Controllers\BookManagementController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login, Register and logout
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('do_login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'doRegister'])->name('do_register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Roles and Permission
// Roles
Route::get('/roles', [PermissionsController::class, 'roles_index'])->name('roles.index');
Route::get('/role/create', [PermissionsController::class, 'roles_create'])->name('roles.create');
Route::post('/role/create', [PermissionsController::class, 'roles_store'])->name('roles.store');
Route::get('/role/{role}/edit', [PermissionsController::class, 'roles_edit'])->name('roles.edit');
Route::post('/role/{role}/update', [PermissionsController::class, 'roles_update'])->name('roles.update');
Route::get('/role/{role}/delete', [PermissionsController::class, 'roles_destroy'])->name('roles.delete');
// Give permission to role
Route::get('/role/{role}/give-permissions', [PermissionsController::class, 'give_permissions'])->name('roles.givePermissions');
Route::post('/roles/{role}/add-permission', [PermissionsController::class, 'add_permission_to_role'])->name('roles.add_permission');
Route::post('/roles/{role}/remove-permission', [PermissionsController::class, 'remove_permission_from_role'])->name('roles.remove_permission');

// Permissions
Route::get('/permissions', [PermissionsController::class, 'permissions_index'])->name('permissions.index');
Route::get('/permission/create', [PermissionsController::class, 'permissions_create'])->name('permissions.create');
Route::post('/permission/create', [PermissionsController::class, 'permissions_store'])->name('permissions.store');
Route::get('/permission/{permission}/edit', [PermissionsController::class, 'permissions_edit'])->name('permissions.edit');
Route::post('/permission/{permission}/update', [PermissionsController::class, 'permissions_update'])->name('permissions.update');
Route::get('/permission/{permission}/delete', [PermissionsController::class, 'permissions_destroy'])->name('permissions.delete');

// Assign Role to Permissions
Route::get('/permissions/{permissions}/assign-role', [PermissionsController::class, 'assign_role'])->name('permissions.givePermissions');
Route::get('/permissions/{permission}/assign-role', [PermissionsController::class, 'assign_role'])->name('permissions.assign_role');
Route::post('/permissions/{permission}/assign-role', [PermissionsController::class, 'store_role_assignment'])->name('permissions.store_role_assignment');

// lec1
Route::get('/multable', function () {
    return view('lec1.multable');
})->name('multable');

Route::get('/even', function () {
    return view('lec1.even_number');
})->name('even');

Route::get('/prime', function () {
    return view('lec1.prime_number');
})->name('prime');

Route::get('/mini-test', function () {
    $bill = new stdClass();
    $bill->items = [
        (object)['name' => 'Apple', 'quantity' => 4, 'price' => 7],
        (object)['name' => 'Banana', 'quantity' => 5, 'price' => 1],
        (object)['name' => 'Orange', 'quantity' => 3, 'price' => 2],
        (object)['name' => 'sss', 'quantity' => 3, 'price' => 2],
    ];
    $bill->total = array_reduce($bill->items, function ($carry, $item) {
        return $carry + ($item->quantity * $item->price);
    }, 0);
    return view('lec1.mini_test', compact('bill'));
})->name('mini-test');

Route::get('/gpa', function () {
    $courses = [
        [
            'code' => 'CS101',
            'name' => 'Introduction to Programming',
            'ch' => 3,
            'grade' => 85,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'CS102',
            'name' => 'Data Structures',
            'ch' => 3,
            'grade' => 92,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'MATH201',
            'name' => 'Calculus I',
            'ch' => 4,
            'grade' => 88,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'ENG101',
            'name' => 'Academic Writing',
            'ch' => 3,
            'grade' => 78,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'HIST101',
            'name' => 'World History',
            'ch' => 3,
            'grade' => 80,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'PHYS101',
            'name' => 'Physics I',
            'ch' => 4,
            'grade' => 75,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'CHEM101',
            'name' => 'General Chemistry',
            'ch' => 4,
            'grade' => 82,
            'gpa' => 0,
            'letter' => ''
        ],
        [
            'code' => 'BIO101',
            'name' => 'Biology I',
            'ch' => 3,
            'grade' => 89,
            'gpa' => 0,
            'letter' => ''
        ]
    ];

    $totalCredits = 0;
    $totalPoints = 0;

    foreach ($courses as &$course) {
        $course['gpa'] = calculateGPA($course['grade']);
        $course['letter'] = getGradeLetter($course['grade']);
        $totalCredits += $course['ch'];
        $totalPoints += $course['gpa'] * $course['ch'];
    }

    $overallGPA = $totalPoints / $totalCredits;
    $overallGradeLetter = getGradeLetter($overallGPA * 25); // Convert GPA back to percentage for letter grade

    return view('lec1.gpa_task', compact('courses', 'overallGPA', 'overallGradeLetter'));
})->name('gpa');

// lec2
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('products/edit/{products?}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('products/save/{products?}', [ProductsController::class, 'store'])->name('products.save');
Route::get('products/delete/{products}', [ProductsController::class, 'destroy'])->name('products.delete');

// Users index
Route::get('/users', [UserController::class, 'index'])->middleware('can:show_users')->name('users.index');
// Users create
Route::get('user/create', [UserController::class, 'create'])->middleware('can:add_users')->name('users.create');
Route::post('user/create', [UserController::class, 'store'])->middleware('can:add_users')->name('users.store');
// Users edit without password
Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::post('user/edit/{user?}', [UserController::class, 'update'])->name('users.update');
// Users edit password
Route::get('user/save/{user}', [UserController::class, 'edit_pass'])->name('users.change_pass');
Route::post('user/save/{user?}', [UserController::class, 'savePass'])->name('users.change_pass.save');
// Users delete
Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->middleware('can:delete_users')->name('users.destroy');
// users profile
Route::get('/user/profile/{user}', [UserController::class, 'profile'])->name('users.profile');

// Assignments 
Route::get('/books', [BookManagementController::class, 'index'])->middleware(['auth'])->name('books.index');
Route::get('/book/create', [BookManagementController::class, 'create'])->middleware(['auth'])->name('books.create');
Route::post('bookManagement', [BookManagementController::class, 'store'])->middleware(['auth'])->name('books.store');
