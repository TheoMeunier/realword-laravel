<?php

declare(strict_types=1);

namespace App\Articles\Resources;

use App\Auth\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class ArticleResource extends ResourceCollection
{
    public static $wrap = 'article';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'tagList' => $this->tags->pluck('title')->toArray(),
            'createdAt' => $this->createdAt->toIso8601String(),
            'updatedAt' => $this->updatedAt->toIso8601String(),
            'favorited' => $this->favoritedBy()->contains(auth()->id()),
            'favoritesCount' => $this->favoritesCount(),
            'author' => ProfileResource::make($this->author),
        ];
    }
}
