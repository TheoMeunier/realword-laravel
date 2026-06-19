<?php

use App\Articles\Models\Article;
use App\Auth\Models\User;

describe('Feed', function () {
    it('returns only articles from followed users', function () {
        $me = actingAsUser();
        $followed = User::factory()->create();
        $other = User::factory()->create();

        $me->following()->attach($followed->id);

        Article::factory(2)->create(['user_id' => $followed->id]);
        Article::factory()->create(['user_id' => $other->id]);

        $this->getJson('/api/articles/feed')
            ->assertOk()
            ->assertJsonPath('articlesCount', 2)
            ->assertJsonCount(2, 'articles');
    });

    it('returns an empty feed when following no one', function () {
        actingAsUser();
        Article::factory(3)->create();

        $this->getJson('/api/articles/feed')
            ->assertOk()
            ->assertJsonPath('articlesCount', 0)
            ->assertJsonCount(0, 'articles');
    });

    it('respects the limit parameter', function () {
        $me = actingAsUser();
        $followed = User::factory()->create();
        $me->following()->attach($followed->id);

        Article::factory(5)->create(['user_id' => $followed->id]);

        $this->getJson('/api/articles/feed?limit=2')
            ->assertOk()
            ->assertJsonCount(2, 'articles')
            ->assertJsonPath('articlesCount', 5);
    });

    it('returns 401 when unauthenticated', function () {
        $this->getJson('/api/articles/feed')->assertStatus(401);
    });
});
