<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Comments;

use App\Articles\Models\Article;
use App\Articles\Models\Comment;
use Illuminate\Http\JsonResponse;

final class DeleteCommentController
{
    public function remove(Article $article, Comment $comment): JsonResponse
    {
        $comment->delete();

        return new JsonResponse(null, 204);
    }
}
