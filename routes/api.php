<?php

declare(strict_types=1);

use App\Articles\Controllers\Articles\DeleteArticleController;
use App\Articles\Controllers\Articles\GetArticleController;
use App\Articles\Controllers\Articles\ListArticlesController;
use App\Articles\Controllers\Articles\ListArticlesFeedController;
use App\Articles\Controllers\Articles\UpdateArticleController;
use App\Articles\Controllers\Comments\DeleteCommentController;
use App\Articles\Controllers\Comments\ListCommentController;
use App\Articles\Controllers\Comments\StoreCommentController;
use App\Articles\Controllers\Favorite\FavoriteArticleController;
use App\Articles\Controllers\Favorite\UnfavoriteArticleController;
use App\Auth\Controllers\LoginController;
use App\Auth\Controllers\RegisterController;
use App\Auth\Controllers\ShowUserController;
use App\Auth\Controllers\UpdateUserController;
use App\Profile\Controllers\FollowController;
use App\Profile\Controllers\UnfollowController;
use Illuminate\Support\Facades\Route;

// route not auth
Route::prefix('user')->name('user.')->group(function (): void {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/', [RegisterController::class, 'register'])->name('register');
});

// route auth
Route::middleware('auth:sanctum')->group(function (): void {
    Route::prefix('user')->name('user.')->group(function (): void {
        Route::get('/', [ShowUserController::class, 'show'])->name('show');
        Route::put('/', [UpdateUserController::class, 'update'])->name('update');
    });

    Route::prefix('profile')->name('profile.')->group(function (): void {
        Route::get('/{username}', [ShowUserController::class, 'show'])->name('show');
        Route::post('/{username}/follow', [FollowController::class, 'follow'])->name('follow');
        Route::delete('/{username}/follow', [UnfollowController::class, 'unfollow'])->name('unfollow');
    });

    Route::prefix('articles')->name('articles.')->group(function (): void {
        Route::get('/', [ListArticlesController::class, 'list'])->name('list');
        Route::get('/feed', [ListArticlesFeedController::class, 'list'])->name('list');
        Route::get('/{article:slug}', [GetArticleController::class, 'show'])->name('show');
        Route::put('/{article:slug}', [UpdateArticleController::class, 'update'])->name('update');
        Route::delete('/{article:slug}', [DeleteArticleController::class, 'remove'])->name('delete');

        // comments
        Route::post('/{article:slug}/comments', [StoreCommentController::class, 'store'])->name('store');
        Route::get('/{article:slug}/comments', [ListCommentController::class, 'list'])->name('index');
        Route::delete('/{article:slug}/comments/{comment}', [DeleteCommentController::class, 'remove'])->name('remove');

        // favorites articles
        Route::post('/{article:slug}/favorite', [FavoriteArticleController::class, 'favorite'])->name('favorite');
        Route::delete('/{article:slug}/favorite', [UnfavoriteArticleController::class, 'unfavorite'])->name('unfavorite');
    });
});
