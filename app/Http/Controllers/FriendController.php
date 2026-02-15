<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\FriendRequestSent; // For Pusher

class FriendController extends Controller
{
    public function sendRequest(User $user)
    {
        $authUser = Auth::user();

        if($authUser->id == $user->id) return back()->with('error', 'Cannot send request to yourself');

        $exists = FriendRequest::where('sender_id', $authUser->id)
            ->where('receiver_id', $user->id)
            ->orWhere(function($q) use($authUser, $user){
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', $authUser->id);
            })->first();

        if($exists) return back()->with('error', 'Request already exists');

        $friendRequest = FriendRequest::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id
        ]);

        event(new FriendRequestSent($friendRequest));

        return back()->with('success', 'Friend request sent');
    }

    public function pendingRequests()
    {
        $requests = Auth::user()->receivedFriendRequests()->where('status','pending')->with('sender')->get();
        return view('friends.pending', compact('requests'));
    }

    public function acceptRequest(FriendRequest $request)
    {
        if ($request->receiver_id != Auth::id()) {
            return $this->sendError('Unauthorized', [], 403);
        }

        $request->update(['status' => 'accepted']);


        Friendship::create(['user_id'=>Auth::id(), 'friend_id'=>$request->sender_id]);
        Friendship::create(['user_id'=>$request->sender_id, 'friend_id'=>Auth::id()]);

        return back()->with('success','Friend request accepted');
    }

    public function rejectRequest(FriendRequest $request)
    {

        if ($request->receiver_id != Auth::id()) {
            return $this->sendError('Unauthorized', [], 403);
        }

        $request->update(['status'=>'rejected']);
        return back()->with('success','Friend request rejected');
    }

    public function friendsList()
    {
        $friends = Auth::user()->friends()->with('profile')->get();
        return view('friends.list', compact('friends'));
    }
}

