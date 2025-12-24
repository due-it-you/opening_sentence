<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PostController;

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

Route::post('/login', [AuthSessionController::class, 'authenticate'])
    ->name('login.authenticate');

Route::post('/logout', [AuthSessionController::class, 'logout'])
    ->name('logout');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::resource('posts', PostController::class);

## 管理者関連のルーティング ##
Route::get('/admin/login', function() {
    return view('admin.login');
});

Route::post('/admin/login', [AdminLoginController::class, 'authenticate'])
        ->name('admin.login');