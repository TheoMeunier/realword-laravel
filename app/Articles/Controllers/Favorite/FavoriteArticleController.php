<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Favorite;

use App\Articles\Actions\Favorites\FavoriteArticleAction;
use App\Articles\Resources\ArticleResource;
use App\Core\Exceptions\NotFoundException;

readonly class FavoriteArticleController
{
    public function __construct(
        private FavoriteArticleAction $favoriteArticleAction
    ) {}

    /**
     * @throws NotFoundException
     */
    public function favorite(string $slug): ArticleResource
    {
        throw_unless(auth()->user(), NotFoundException::class);

        return $this->favoriteArticleAction->handle($slug, auth()->user());
    }
}
