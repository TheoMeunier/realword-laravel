<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use Illuminate\Http\JsonResponse;

class DeleteArticleController
{
    public function remove(string $slug): JsonResponse
    {
        $article = Article::query()->where('slug', $slug)->firstOrFail();
        $article->delete();

        return new JsonResponse(null, 204);
    }
}
