<?php

declare(strict_types=1);

namespace App\Articles\Models;

use App\Auth\Models\User;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'slug', 'description', 'body', 'user_id'])]
final class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }

    // relations
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function favorite(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // getters
    public function favoritesCount(): int
    {
        return $this->favorite()->count();
    }

    public function favorited(): bool
    {
        return $this->favorite()->where('user_id', auth()->id())->exists();
    }
}
