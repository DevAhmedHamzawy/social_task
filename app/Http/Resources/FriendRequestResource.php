<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,

            'sender' => [
                'id' => $this->sender->id ?? null,
                'name' => $this->sender->name ?? null,
                'avatar' => $this->sender->profile->avatar ?? null,
            ],

            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
