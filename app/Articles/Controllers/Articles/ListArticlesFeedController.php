<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Models\Article;
use App\Articles\Resources\ArticleResource;
use App\Core\Exceptions\NotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListArticlesFeedController
{
    /**
     * @throws \Throwable
     */
    public function list(Request $request): JsonResponse
    {
        throw_unless(auth()->user(), NotFoundException::class);

        $followedIds = auth()->user()->following()->pluck('users.id');

        $total = Article::query()->whereIn('user_id', $followedIds)->count();

        $articles = Article::with(['author', 'tags', 'favorites'])
            ->whereIn('user_id', $followedIds)
            ->latest()
            ->skip((int) $request->input('offset', 0))
            ->take((int) $request->input('limit', 20))
            ->get();

        return response()->json([
            'articles' => ArticleResource::collection($articles),
            'articlesCount' => $total,
        ]);
    }
}
