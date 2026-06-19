<?php

declare(strict_types=1);

namespace App\Articles\Actions\Favorites;

use App\Articles\Models\Article;
use App\Articles\Models\Favorite;
use App\Articles\Resources\ArticleResource;
use App\Auth\Models\User;

class UnfavoriteArticleAction
{
    public function handle(string $articleSlug, User $user): ArticleResource
    {
        $article = Article::query()->where('slug', $articleSlug)->firstOrFail();

        Favorite::query()->where([
            'user_id' => $user->id,
            'article_id' => $article->id,
        ])->delete();

        return ArticleResource::make($article);
    }
}
