<?php

use App\Http\Controllers\ProductsController;
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
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');