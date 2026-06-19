<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Comments;

use App\Articles\Actions\Comments\StoreCommentAction;
use App\Articles\Models\Article;
use App\Articles\Requests\StoreCommentRequest;
use App\Articles\Resources\CommentResource;

readonly class StoreCommentController
{
    public function __construct(
        private StoreCommentAction $storeCommentAction
    ) {}

    public function store(Article $article, StoreCommentRequest $request): CommentResource
    {
        return $this->storeCommentAction->execute($article, $request);
    }
}
