<?php

declare(strict_types=1);

use App\Auth\Controllers\LoginController;
use App\Auth\Controllers\RegisterController;
use App\Auth\Controllers\ShowUserController;
use App\Auth\Controllers\UpdateUserController;
use App\Profile\Controllers\FollowController;
use App\Profile\Controllers\UnfollowController;
use Illuminate\Support\Facades\Route;

// route not auth
Route::prefix('user')->name('user.')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/', [RegisterController::class, 'register'])->name('register');
});

// route auth
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [ShowUserController::class, 'show'])->name('show');
        Route::put('/', [UpdateUserController::class, 'update'])->name('update');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/{username}', [ShowUserController::class, 'show'])->name('show');
        Route::post('/{username}/follow', [FollowController::class, 'follow'])->name('follow');
        Route::delete('/{username}/follow', [UnfollowController::class, 'unfollow'])->name('unfollow');
    });
});


