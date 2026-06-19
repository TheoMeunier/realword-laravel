<?php

use App\Articles\Models\Article;
use App\Articles\Models\Comment;

describe('List comments', function () {
    it('returns all comments for an article', function () {
        actingAsUser();
        $article = Article::factory()->create();
        Comment::factory(3)->create(['article_id' => $article->id]);

        $this->getJson("/api/articles/{$article->slug}/comments")
            ->assertOk()
            ->assertJsonStructure(['comment'])
            ->assertJsonCount(3, 'comment');
    });

    it('returns an empty list when no comments exist', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->getJson("/api/articles/{$article->slug}/comments")
            ->assertOk()
            ->assertJsonCount(0, 'comment');
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->getJson('/api/articles/non-existent/comments')->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->getJson("/api/articles/{$article->slug}/comments")->assertStatus(401);
    });
});

describe('Create comment', function () {
    it('adds a comment to an article', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->postJson("/api/articles/{$article->slug}/comments", [
            'body' => 'Great article!',
        ])->assertCreated()
            ->assertJsonStructure([
                'comment' => ['id', 'body', 'createdAt', 'updatedAt', 'author'],
            ])
            ->assertJsonPath('comment.body', 'Great article!');

        expect($article->comments()->count())->toBe(1);
    });

    it('links the comment to the authenticated user', function () {
        $user = actingAsUser();
        $article = Article::factory()->create();

        $this->postJson("/api/articles/{$article->slug}/comments", [
            'body' => 'My comment',
        ])->assertCreated();

        expect($article->comments()->where('user_id', $user->id)->exists())->toBeTrue();
    });

    it('returns 404 for non-existent article', function () {
        actingAsUser();

        $this->postJson('/api/articles/non-existent/comments', ['body' => 'Hello'])
            ->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();

        $this->postJson("/api/articles/{$article->slug}/comments", ['body' => 'Hello'])
            ->assertStatus(401);
    });
});

describe('Delete comment', function () {
    it('allows the author to delete their comment', function () {
        $user = actingAsUser();
        $article = Article::factory()->create();
        $comment = Comment::factory()->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);

        $this->deleteJson("/api/articles/{$article->slug}/comments/{$comment->id}")
            ->assertStatus(204);

        expect(Comment::find($comment->id))->toBeNull();
    });

    it('returns 403 when user is not the comment author', function () {
        actingAsUser();
        $article = Article::factory()->create();
        $comment = Comment::factory()->create(['article_id' => $article->id]);

        $this->deleteJson("/api/articles/{$article->slug}/comments/{$comment->id}")
            ->assertStatus(403);
    });

    it('returns 404 for non-existent comment', function () {
        actingAsUser();
        $article = Article::factory()->create();

        $this->deleteJson("/api/articles/{$article->slug}/comments/999")
            ->assertStatus(404);
    });

    it('returns 401 when unauthenticated', function () {
        $article = Article::factory()->create();
        $comment = Comment::factory()->create(['article_id' => $article->id]);

        $this->deleteJson("/api/articles/{$article->slug}/comments/{$comment->id}")
            ->assertStatus(401);
    });
});
