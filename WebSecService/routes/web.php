<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/multable', function () {
    return view('multable');
})->name('multable');

Route::get('/even', function () {
    return view('even_number');
})->name('even');

Route::get('/prime', function () {
    return view('prime_number');
})->name('prime');

Route::get('/mini-test', function () {
    $bill = new stdClass();
    $bill->items = [
        (object)['name' => 'Apple', 'quantity' => 4, 'price' => 7],
        (object)['name' => 'Banana', 'quantity' => 5, 'price' => 1],
        (object)['name' => 'Orange', 'quantity' => 3, 'price' => 2],
        (object)['name' => 'sss', 'quantity' => 3, 'price' => 2],
        (object)['name' => 'qq', 'quantity' => 3, 'price' => 2],
    ];
    $bill->total = array_reduce($bill->items, function ($carry, $item) {
        return $carry + ($item->quantity * $item->price);
    }, 0);
    return view('mini_test', compact('bill'));
})->name('mini-test');

// Route::get('/transcript', function () {
//     $transcript = [
//         ['course' => 'Mathematics', 'grade' => 'A'],
//         ['course' => 'Physics', 'grade' => 'B+'],
//         ['course' => 'Chemistry', 'grade' => 'A-'],
//         ['course' => 'Biology', 'grade' => 'B'],
//         ['course' => 'History', 'grade' => 'A']
//     ];
//     return view('transcript', compact('transcript'));
// })->name('transcript');
