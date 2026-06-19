<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Favorite;

use App\Articles\Actions\Favorites\FavoriteArticleAction;
use App\Articles\Resources\ArticleResource;

readonly class FavoriteArticleController
{
    public function __construct(
        private FavoriteArticleAction $favoriteArticleAction
    ) {}

    public function favorite(string $slug): ArticleResource
    {
        return $this->favoriteArticleAction->handle($slug, auth()->user());
    }
}
