<?php

declare(strict_types=1);

namespace App\Articles\Actions\Articles;

use App\Articles\Models\Article;
use App\Articles\Models\Tag;
use App\Articles\Requests\StoreArticleRequest;
use App\Articles\Resources\ArticleResource;

final class StoreArticleAction
{
    public function execute(StoreArticleRequest $request): ArticleResource
    {
        $article = new Article;
        $article->title = $request->title;
        $article->slug = str()->slug($request->title);
        $article->description = $request->description;
        $article->body = $request->body;

        $article->save();

        if ($request->has('article.tagList')) {
            $tagRows = collect($request->article['tagList'])->map(fn ($tag): array => [
                'title' => $tag,
                'article_id' => $article->id,
            ])->all();

            Tag::query()->insert($tagRows);
        }

        return new ArticleResource($article);
    }
}
