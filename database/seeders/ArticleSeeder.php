<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Articles\Models\Article;
use App\Articles\Models\Comment;
use App\Articles\Models\Tag;
use App\Auth\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $users->each(function (User $user) use ($users): void {
            Article::factory(3)
                ->create(['user_id' => $user->id])
                ->each(function (Article $article) use ($users): void {
                    Comment::factory(random_int(1, 4))->create([
                        'article_id' => $article->id,
                        'user_id' => $users->random()->id,
                    ]);

                    Tag::factory(random_int(1, 3))->create([
                        'article_id' => $article->id,
                    ]);

                    $favoriters = $users->random(random_int(0, min(3, $users->count())));
                    foreach ($favoriters as $favoriter) {
                        DB::table('article_favorites')->insertOrIgnore([
                            'user_id' => $favoriter->id,
                            'article_id' => $article->id,
                        ]);
                    }
                });
        });
    }
}
