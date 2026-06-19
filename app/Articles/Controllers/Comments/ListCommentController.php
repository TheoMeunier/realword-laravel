<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Comments;

use App\Articles\Models\Article;
use App\Articles\Resources\CommentResource;

class ListCommentController
{
    public function list(Article $article): CommentResource
    {
        $article->load('comments.author');

        return new CommentResource($article->comments);
    }
}
