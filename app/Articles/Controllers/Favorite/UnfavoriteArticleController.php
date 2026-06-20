<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Favorite;

use App\Articles\Actions\Favorites\UnfavoriteArticleAction;
use App\Articles\Resources\ArticleResource;
use App\Core\Exceptions\NotFoundException;

readonly class UnfavoriteArticleController
{
    public function __construct(
        private UnfavoriteArticleAction $unfavoriteArticleAction
    ) {}

    /**
     * @throws NotFoundException
     */
    public function unfavorite(string $slug): ArticleResource
    {
        throw_unless(auth()->user(), NotFoundException::class);

        return $this->unfavoriteArticleAction->handle($slug, auth()->user());
    }
}
