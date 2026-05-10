<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Comments;

use App\Articles\Models\Article;
use App\Articles\Resources\CommentResource;

class ListCommentController
{
    public function list(string $slug): CommentResource
    {
        $article = Article::query()->with('comments')->where('slug', $slug)->firstOrFail();

        return new CommentResource($article->comments);
    }
}
