<?php

use App\Articles\Models\Article;
use App\Articles\Models\Tag;

describe('Get article', function () {
    it('returns an article by slug', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->getJson("/api/articles/{$article->slug}")
            ->assertOk()
            ->assertJsonStructure([
                'article' => ['title', 'slug', 'description', 'body', 'tagList', 'favorited', 'favoritesCount', 'author'],
            ])
            ->assertJsonPath('article.slug', $article->slug);
    });

    it('includes the tag list', function () {
        actingAsUser();
        $article = Article::factory()->create();
        Tag::factory()->create(['title' => 'pest', 'article_id' => $article->id]);
        Tag::factory()->create(['title' => 'laravel', 'article_id' => $article->id]);

        $this->getJson("/api/articles/{$article->slug}")
            ->assertOk()
            ->assertJsonCount(2, 'article.tagList');
    });

    it('shows favorited as true when user has favorited the article', function () {
        $user = actingAsUser();
        $article = Article::factory()->create();
        $article->favorites()->attach($user->id);

        $this->getJson("/api/articles/{$article->slug}")
            ->assertOk()
            ->assertJsonPath('article.favorited', true)
            ->assertJsonPath('article.favoritesCount', 1);
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->getJson('/api/articles/non-existent-slug')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->getJson("/api/articles/{$article->slug}")->assertStatus(401);
    });
});
