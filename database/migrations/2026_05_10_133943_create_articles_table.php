<?php

declare(strict_types=1);

use App\Articles\Models\Article;
use App\Auth\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description');
            $table->text('body');

            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('article_favorites', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Article::class)->constrained('articles')->onDelete('cascade');
        });

        Schema::create('article_tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(Article::class)->constrained('articles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('articles_favorites');
        Schema::dropIfExists('articles_tags');
    }
};
