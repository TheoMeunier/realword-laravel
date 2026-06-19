<?php

use App\Articles\Models\Article;

describe('Favorite article', function () {
    it('can favorite an article', function () {
        $user = actingAsUser();
        $article = Article::factory()->create();

        $this->postJson("/api/articles/{$article->slug}/favorite")
            ->assertOk()
            ->assertJsonPath('article.favorited', true)
            ->assertJsonPath('article.favoritesCount', 1);

        expect($article->favorites()->where('user_id', $user->id)->exists())->toBeTrue();
    });

    it('favoriting twice does not create duplicates', function () {
        $user = actingAsUser();
        $article = Article::factory()->create();

        $this->postJson("/api/articles/{$article->slug}/favorite");
        $this->postJson("/api/articles/{$article->slug}/favorite");

        expect($article->favorites()->count())->toBe(1);
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->postJson('/api/articles/non-existent/favorite')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->postJson("/api/articles/{$article->slug}/favorite")->assertStatus(401);
    });
});

describe('Unfavorite article', function () {
    it('can unfavorite an article', function () {
        $user = actingAsUser();
        $article = Article::factory()->create();
        $article->favorites()->attach($user->id);

        $this->deleteJson("/api/articles/{$article->slug}/favorite")
            ->assertOk()
            ->assertJsonPath('article.favorited', false)
            ->assertJsonPath('article.favoritesCount', 0);

        expect($article->favorites()->where('user_id', $user->id)->exists())->toBeFalse();
    });

    it('unfavoriting a non-favorited article does nothing', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->deleteJson("/api/articles/{$article->slug}/favorite")
            ->assertOk()
            ->assertJsonPath('article.favoritesCount', 0);
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->deleteJson('/api/articles/non-existent/favorite')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->deleteJson("/api/articles/{$article->slug}/favorite")->assertStatus(401);
    });
});
