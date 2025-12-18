<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('top');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');