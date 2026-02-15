<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,

            'image' => $this->image
                ? asset('storage/' . $this->image)
                : null,

            'author' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'avatar' => $this->user->profile->image ?? null,
            ],

            'likes_count' => $this->likes->count(),
            'comments_count' => $this->comments->count(),

            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
