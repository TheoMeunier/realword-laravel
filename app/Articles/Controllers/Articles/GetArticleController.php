<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use App\Articles\Resources\ArticleResource;
use App\Core\Exceptions\NotFoundException;

class GetArticleController
{
    /**
     * @throws NotFoundException
     */
    public function show(string $slug): ArticleResource
    {
        $article = Article::query()->with(['author', 'tags'])->where('slug', $slug)->firstOrFail();

        return new ArticleResource($article);
    }
}
