<?php

declare(strict_types=1);

namespace App\Articles\Actions\Articles;

use App\Articles\Models\Article;
use App\Articles\Requests\UpdateArticleRequest;
use App\Articles\Resources\ArticleResource;

final class UpdateArticleAction
{
    public function execute(string $slug, UpdateArticleRequest $request): ArticleResource
    {
        $article = Article::query()->with(['author', 'tags', 'favorites'])->where('slug', $slug)->firstOrFail();

        $article->title = $request->title;
        $article->description = $request->description;
        $article->body = $request->body;

        if ($request->has('title')) {
            $article->slug = str()->slug($request->title);
        }

        $article->save();

        return new ArticleResource($article);
    }
}
