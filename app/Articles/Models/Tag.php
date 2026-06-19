<?php

namespace App\Articles\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'article_id'])]
#[\Illuminate\Database\Eloquent\Attributes\Table(name: 'article_tags')]
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }
}
