<?php

declare(strict_types=1);

namespace App\Articles\Actions\Articles;

use App\Articles\Models\Article;
use App\Articles\Models\Tag;
use App\Articles\Requests\UpdateArticleRequest;
use App\Articles\Resources\ArticleResource;
use Illuminate\Support\Facades\Gate;

final class UpdateArticleAction
{
    public function execute(Article $article, UpdateArticleRequest $request): ArticleResource
    {
        Gate::authorize('update', $article);

        if ($request->filled('title')) {
            $article->title = $request->input('title');
            $article->slug = str()->slug($request->input('title'));
        }

        if ($request->filled('description')) {
            $article->description = $request->input('description');
        }

        if ($request->filled('body')) {
            $article->body = $request->input('body');
        }

        $article->save();

        if ($request->has('article.tagList')) {
            $article->tags()->delete();

            $tagRows = collect((array) $request->article['tagList'])->map(fn (string $tag): array => [
                'title' => $tag,
                'article_id' => $article->id,
            ])->all();

            Tag::query()->insert($tagRows);
        }

        $article->load(['author', 'tags', 'favorites']);

        return new ArticleResource($article);
    }
}
