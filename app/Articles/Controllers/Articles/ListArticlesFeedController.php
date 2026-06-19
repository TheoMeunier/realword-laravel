<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use App\Articles\Resources\ArticleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListArticlesFeedController
{
    public function list(Request $request): JsonResponse
    {
        $followedIds = auth()->user()->following()->pluck('user.id');

        $query = Article::with(['author', 'tags', 'favoritedBy'])
            ->whereIn('user_id', $followedIds)
            ->latest()
            ->skip((int) $request->input('offset', 0))
            ->take((int) $request->input('limit', 20))
            ->get();

        return response()->json([
            'articles' => ArticleResource::collection($query),
            'articlesCount' => $query->count(),
        ]);
    }
}
