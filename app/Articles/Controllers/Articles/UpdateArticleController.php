<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Actions\Articles\UpdateArticleAction;
use App\Articles\Requests\UpdateArticleRequest;
use Illuminate\Http\JsonResponse;

readonly class UpdateArticleController
{
    public function __construct(
        private UpdateArticleAction $updateArticleAction
    ) {}

    public function update(string $slug, UpdateArticleRequest $request): JsonResponse
    {
        return $this->updateArticleAction->execute($slug, $request)->response();
    }
}
