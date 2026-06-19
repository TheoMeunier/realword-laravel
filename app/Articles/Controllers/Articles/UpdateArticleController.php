<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Actions\Articles\UpdateArticleAction;
use App\Articles\Models\Article;
use App\Articles\Requests\UpdateArticleRequest;
use App\Articles\Resources\ArticleResource;

readonly class UpdateArticleController
{
    public function __construct(
        private UpdateArticleAction $updateArticleAction
    ) {}

    public function update(Article $article, UpdateArticleRequest $request): ArticleResource
    {
        return $this->updateArticleAction->execute($article, $request);
    }
}
