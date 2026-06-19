<?php

declare(strict_types=1);

namespace App\Articles\Actions\Comments;

use App\Articles\Models\Article;
use App\Articles\Requests\StoreCommentRequest;
use App\Articles\Resources\CommentResource;

final class StoreCommentAction
{
    public function execute(Article $article, StoreCommentRequest $request): CommentResource
    {
        $comment = $article->comments()->create([
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
        ]);

        $comment->load('author');

        return new CommentResource($comment);
    }
}
