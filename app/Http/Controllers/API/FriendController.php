<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\FriendRequestResource;
use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\FriendRequestSent;
use App\Http\Resources\FriendResource;

class FriendController extends BaseController
{
    public function sendRequest(User $user)
    {
        $authUser = Auth::user();

        if ($authUser->id == $user->id) {
            return $this->sendError('Cannot send request to yourself');
        }

        $exists = FriendRequest::where('sender_id', $authUser->id)
            ->where('receiver_id', $user->id)
            ->orWhere(function ($q) use ($authUser, $user) {
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', $authUser->id);
            })->first();

        if ($exists) {
            return $this->sendError('Request already exists');
        }

        $friendRequest = FriendRequest::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id
        ]);

        event(new FriendRequestSent($friendRequest));

        return $this->sendResponse(new FriendRequestResource($friendRequest), 'Friend request sent');
    }

    public function pendingRequests()
    {
        $requests = Auth::user()
            ->receivedFriendRequests()
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        return $this->sendResponse(FriendRequestResource::collection($requests), 'Pending requests');
    }

    public function acceptRequest(FriendRequest $request)
    {
        $request->update(['status' => 'accepted']);

        Friendship::create([
            'user_id' => Auth::id(),
            'friend_id' => $request->sender_id
        ]);

        Friendship::create([
            'user_id' => $request->sender_id,
            'friend_id' => Auth::id()
        ]);

        return $this->sendResponse([], 'Friend request accepted');
    }

    public function rejectRequest(FriendRequest $request)
    {
        $request->update(['status' => 'rejected']);

        return $this->sendResponse([], 'Friend request rejected');
    }

    public function friendsList()
    {
        $friends = Auth::user()->friends()->with('profile')->get();

        return $this->sendResponse(FriendResource::collection($friends), 'Friends list');
    }
}
