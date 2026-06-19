<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class DeleteArticleController
{
    public function remove(Article $article): JsonResponse
    {
        Gate::authorize('delete', $article);

        $article->delete();

        return new JsonResponse(null, 204);
    }
}
