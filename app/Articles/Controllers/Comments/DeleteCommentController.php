<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Comments;

use App\Articles\Models\Article;
use App\Articles\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class DeleteCommentController
{
    public function remove(Article $article, Comment $comment): JsonResponse
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return new JsonResponse(null, 204);
    }
}
