<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use App\Articles\Resources\ArticleResource;

class GetArticleController
{
    public function show(Article $article): ArticleResource
    {
        $article->load(['author', 'tags', 'favorites']);

        return new ArticleResource($article);
    }
}
