<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('profile');

        return view('users.show', compact('user'));
    }
}
