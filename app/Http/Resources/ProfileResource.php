<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,

            'profile' => [
                'bio' => $this->profile->bio ?? null,
                'image' => $this->profile->image
                    ? asset('storage/' . $this->profile->image)
                    : null,
            ],
        ];
    }
}
