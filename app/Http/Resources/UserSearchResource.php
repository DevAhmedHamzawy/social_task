<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $auth = auth()->user();

        $isFriend = $auth->friends->contains($this->id);

        $sentRequest = $auth->sentFriendRequests
            ->where('receiver_id', $this->id)
            ->where('status', 'pending')
            ->isNotEmpty();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,

            'avatar' => $this->profile
                ? asset('storage/' . $this->profile->image)
                : null,

            'relation' => $isFriend
                ? 'friend'
                : ($sentRequest ? 'pending' : 'none'),
        ];
    }
}
