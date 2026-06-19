<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Articles\Models\Article;
use App\Articles\Models\Comment;
use App\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'body' => fake()->paragraph(),
            'user_id' => User::factory(),
            'article_id' => Article::factory(),
        ];
    }
}
