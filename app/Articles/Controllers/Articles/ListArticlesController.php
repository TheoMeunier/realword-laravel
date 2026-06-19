<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use App\Articles\Resources\ArticleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListArticlesController
{
    public function list(Request $request): JsonResponse
    {
        $query = Article::with(['author', 'tags', 'favorites'])
            ->latest()
            ->skip((int) $request->input('offset', 0))
            ->take((int) $request->input('limit', 20))
            ->tag($request->tag)
            ->byAuthor($request->author)
            ->favoritedBy($request->favorited);

        return response()->json([
            'articles' => ArticleResource::collection($query->get()),
            'articlesCount' => Article::query()->count(),
        ]);
    }
}
