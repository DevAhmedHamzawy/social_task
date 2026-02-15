<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::with(['user.profile', 'likes', 'comments.user'])
            ->latest()
            ->paginate(10);

        return $this->sendResponse(
            PostResource::collection($posts)->response()->getData(true),
            'Posts list'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('posts', 'public');
        }

        $post = Auth::user()->posts()->create([
            'content' => $request->content,
            'image' => $image
        ]);

        $post->load('user.profile');

        return $this->sendResponse(
            new PostResource($post),
            'Post created'
        );
    }

    public function show(Post $post)
    {
        $post->load(['user.profile', 'likes.user', 'comments.user']);

        return $this->sendResponse(
            new PostResource($post),
            'Post details'
        );
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        if ($request->hasFile('image')) {

            // delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'content' => $request->content,
        ]);

        return $this->sendResponse(
            new PostResource($post->load('user.profile')),
            'Post updated'
        );
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return $this->sendResponse([], 'Post deleted');
    }

    public function likes(Post $post)
    {
        $post->load('likes.user.profile');

        return $this->sendResponse(
            $post->likes,
            'Post likes'
        );
    }
}
