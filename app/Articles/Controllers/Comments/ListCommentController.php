<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Comments;

use App\Articles\Models\Article;
use App\Articles\Resources\CommentResource;
use Illuminate\Http\JsonResponse;

class ListCommentController
{
    public function list(Article $article): JsonResponse
    {
        $article->load('comments.author');

        return response()->json([
            'comment' => CommentResource::collection($article->comments)->resolve(),
        ]);
    }
}
