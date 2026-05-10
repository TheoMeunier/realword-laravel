<?php

declare(strict_types=1);

namespace App\Articles\Actions\Comments;

use App\Articles\Models\Article;
use App\Articles\Requests\StoreCommentRequest;
use App\Articles\Resources\CommentResource;

final class StoreCommentAction
{
    public function execute(string $string, StoreCommentRequest $request): CommentResource
    {
        $article = Article::query()->where('slug', $string)->firstOrFail();

        $comment = $article->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return new CommentResource($comment);
    }
}
