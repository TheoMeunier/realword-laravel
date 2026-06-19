<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Articles\Models\Article;
use App\Articles\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'article_id' => Article::factory(),
        ];
    }
}
