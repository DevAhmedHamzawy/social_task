<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProfileResource;

class ProfileController extends BaseController
{
    public function show()
    {
        $user = Auth::user()->load('profile');

        return $this->sendResponse(
            new ProfileResource($user),
            'Profile data'
        );
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        $user = Auth::user();

        // update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $data = [
            'bio' => $request->bio,
        ];

        // upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('profiles', 'public');
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        $user->load('profile');

        return $this->sendResponse(
            new ProfileResource($user),
            'Profile updated successfully'
        );
    }
}
