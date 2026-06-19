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
        $query = Article::query()
            ->latest()
            ->tag($request->tag)
            ->byAuthor($request->author)
            ->favoritedBy($request->favorited);

        $total = $query->count();

        $articles = $query
            ->with(['author', 'tags', 'favorites'])
            ->skip((int) $request->input('offset', 0))
            ->take((int) $request->input('limit', 20))
            ->get();

        return response()->json([
            'articles' => ArticleResource::collection($articles),
            'articlesCount' => $total,
        ]);
    }
}
