<?php

use App\Articles\Models\Article;
use App\Articles\Models\Tag;
use App\Auth\Models\User;

describe('List articles', function () {
    it('returns a list of articles with count (public route)', function () {
        Article::factory(3)->create();

        $this->getJson('/api/articles')
            ->assertOk()
            ->assertJsonStructure(['articles', 'articlesCount'])
            ->assertJsonPath('articlesCount', 3);
    });

    it('paginates with limit and offset', function () {
        Article::factory(5)->create();

        $this->getJson('/api/articles?limit=2&offset=0')
            ->assertOk()
            ->assertJsonCount(2, 'articles');

        $this->getJson('/api/articles?limit=2&offset=4')
            ->assertOk()
            ->assertJsonCount(1, 'articles');
    });

    it('filters by tag', function () {
        $article = Article::factory()->create();
        Tag::factory()->create(['title' => 'laravel', 'article_id' => $article->id]);
        Article::factory()->create();

        $this->getJson('/api/articles?tag=laravel')
            ->assertOk()
            ->assertJsonPath('articlesCount', 1);
    });

    it('filters by author username', function () {
        $author = User::factory()->create(['username' => 'author1']);
        Article::factory(2)->create(['user_id' => $author->id]);
        Article::factory()->create();

        $this->getJson('/api/articles?author=author1')
            ->assertOk()
            ->assertJsonPath('articlesCount', 2);
    });

    it('returns an empty list when no articles exist', function () {
        $this->getJson('/api/articles')
            ->assertOk()
            ->assertJsonPath('articlesCount', 0)
            ->assertJsonCount(0, 'articles');
    });
});
