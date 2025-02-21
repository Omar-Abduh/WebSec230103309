<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/even', function () {
    return view('multable');
});

Route::get('/even', function () {
    return view('even_number');
});

Route::get('/prime', function () {
    return view('prime_number');
});
