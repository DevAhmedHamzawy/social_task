<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends BaseController
{
    public function toggle(Post $post)
    {
        $userId = Auth::id();

        $like = $post->likes()
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();

            return $this->sendResponse([
                'liked' => false,
                'likes_count' => $post->likes()->count()
            ], 'Like removed');
        }

        $post->likes()->create([
            'user_id' => $userId
        ]);

        return $this->sendResponse([
            'liked' => true,
            'likes_count' => $post->likes()->count()
        ], 'Post liked');
    }
}
