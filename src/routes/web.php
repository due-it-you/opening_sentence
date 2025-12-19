<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('top');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/signup', [SignupController::class, 'store'])
    ->name('signup.store');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate');
