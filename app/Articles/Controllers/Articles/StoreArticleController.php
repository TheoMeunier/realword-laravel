<?php

declare(strict_types=1);

namespace App\Articles\Controllers\Articles;

use App\Articles\Actions\Articles\StoreArticleAction;
use App\Articles\Requests\StoreArticleRequest;
use Illuminate\Http\JsonResponse;

readonly class StoreArticleController
{
    public function __construct(
        private StoreArticleAction $storeArticleAction
    ) {}

    public function update(StoreArticleRequest $request): JsonResponse
    {
        return $this->storeArticleAction->execute($request)->response();
    }
}
