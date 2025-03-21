<?php

use App\Http\Controllers\BookManagementController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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

// Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('user/create', [UserController::class, 'create'])->name('users.create');
Route::post('user/create', [UserController::class, 'store'])->name('users.store');
Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::post('user/save/{user?}', [UserController::class, 'update'])->name('users.update');
Route::get('user/save/{user}', [UserController::class, 'edit_pass'])->name('users.change_pass');
Route::post('user/save/{user}', [UserController::class, 'savePass'])->name('users.change_pass.save');
Route::get('user/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Login and Register
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('do_login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'doRegister'])->name('do_register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// user profile
Route::get('/user/profile/{user}', [UserController::class,'profile'])->name('users.profile');

//  
// Assignments 
Route::get('/books', [BookManagementController::class, 'index'])->middleware(['auth'])->name('books.index');
Route::get('/book/create', [BookManagementController::class, 'create'])->middleware(['auth'])->name('books.create');

Route::post('bookManagement', [BookManagementController::class, 'store'])->middleware(['auth'])->name('books.store');