<?php

use App\Articles\Models\Article;

describe('Delete article', function () {
    it('allows the author to delete their article', function () {
        $user = actingAsUser();
        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->deleteJson("/api/articles/{$article->slug}")
            ->assertStatus(204);

        expect(Article::find($article->id))->toBeNull();
    });

    it('returns 403 when user is not the author', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->deleteJson("/api/articles/{$article->slug}")
            ->assertStatus(403);
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->deleteJson('/api/articles/non-existent')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->deleteJson("/api/articles/{$article->slug}")->assertStatus(401);
    });
});
