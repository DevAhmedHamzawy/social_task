<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserSearchResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends BaseController
{
    public function search(Request $request)
    {
        $query = $request->q;

        $users = User::with('profile')
            ->where('id', '!=', auth()->id())
            ->when($query, function ($qBuilder) use ($query) {
                $qBuilder->where('name', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%");
            })
            ->limit(20)
            ->get();

        return $this->sendResponse(
            UserSearchResource::collection($users),
            'Search results'
        );
    }
}
