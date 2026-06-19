<?php

declare(strict_types=1);

namespace App\Articles\Policies;

use App\Articles\Models\Article;
use App\Auth\Models\User;

class ArticlePolicy
{
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }
}
