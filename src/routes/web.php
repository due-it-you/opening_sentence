<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\EnsureNotAuthenticated;
use App\Http\Middleware\EnsureUserIsAdmin;

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

Route::post('/login', [UserAuthController::class, 'authenticate'])
    ->name('login.authenticate');

Route::post('/logout', [UserAuthController::class, 'logout'])
    ->name('logout');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::resource('posts', PostController::class);

## 管理者関連のルーティング ##

## いずれも認証していない場合のみアクセス可能
Route::prefix('admin')
    ->middleware(EnsureNotAuthenticated::class)
    ->group(function () {
        Route::get('/login', function () {
            return view('admin.login');
        });

        Route::post('/login', [AdminLoginController::class, 'authenticate'])
            ->name('admin.login');
    });


## 管理者として認証済の場合のみアクセス可能
Route::prefix('admin')
    ->middleware([EnsureUserIsAdmin::class])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });

        Route::post('/logout', [AdminLoginController::class, 'logout'])
            ->name('admin.logout');
    });
