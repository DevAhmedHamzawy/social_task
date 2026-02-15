<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function index(Request $request)
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

        return view('users.search', compact('users', 'query'));
    }
}
