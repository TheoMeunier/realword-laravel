<?php

declare(strict_types=1);

namespace App\Articles\Resources;

use App\Profile\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'body' => $this->body,
            'tagList' => $this->tags->pluck('title')->toArray(),
            'createdAt' => $this->created_at->toIso8601String(),
            'updatedAt' => $this->updated_at->toIso8601String(),
            'favorited' => $this->favoritedBy()->contains(auth()->id()),
            'favoritesCount' => $this->favoritesCount(),
            'author' => ProfileResource::make($this->author),
        ];
    }
}
