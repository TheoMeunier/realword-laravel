<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Articles\Models\Article;
use App\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(6, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'user_id' => User::factory(),
        ];
    }
}
