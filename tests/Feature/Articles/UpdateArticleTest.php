<?php

use App\Articles\Models\Article;

describe('Update article', function () {
    it('allows the author to update the title', function () {
        $user = actingAsUser();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->putJson("/api/articles/{$article->slug}", [
            'title' => 'Updated Title',
        ])->assertOk()->assertJsonPath('article.title', 'Updated Title');
    });

    it('updates the slug when title changes', function () {
        $user = actingAsUser();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->putJson("/api/articles/{$article->slug}", [
            'title' => 'My New Title',
        ])->assertOk()->assertJsonPath('article.slug', 'my-new-title');
    });

    it('only updates provided fields', function () {
        $user = actingAsUser();
        $article = Article::factory()->create([
            'user_id' => $user->id,
            'body' => 'Original body',
            'description' => 'Original description',
        ]);

        $this->putJson("/api/articles/{$article->slug}", [
            'title' => 'New Title',
        ])->assertOk();

        $article->refresh();
        expect($article->body)->toBe('Original body');
        expect($article->description)->toBe('Original description');
    });

    it('returns 403 when user is not the author', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->putJson("/api/articles/{$article->slug}", ['title' => 'Hacked'])
            ->assertStatus(403);
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->putJson('/api/articles/non-existent', ['title' => 'X'])
            ->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->putJson("/api/articles/{$article->slug}", ['title' => 'X'])
            ->assertStatus(401);
    });
});
