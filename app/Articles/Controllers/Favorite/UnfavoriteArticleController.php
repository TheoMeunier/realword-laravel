<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Favorite;

use App\Articles\Actions\Favorites\UnfavoriteArticleAction;
use App\Articles\Resources\ArticleResource;

readonly class UnfavoriteArticleController
{
    public function __construct(
        private UnfavoriteArticleAction $unfavoriteArticleAction
    ) {}

    public function unfavorite(string $slug): ArticleResource
    {
        return $this->unfavoriteArticleAction->handle($slug, auth()->user());
    }
}
