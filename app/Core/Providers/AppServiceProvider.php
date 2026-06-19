<?php

declare(strict_types=1);

namespace App\Core\Providers;

use App\Articles\Models\Article;
use App\Articles\Models\Comment;
use App\Articles\Policies\ArticlePolicy;
use App\Articles\Policies\CommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}
