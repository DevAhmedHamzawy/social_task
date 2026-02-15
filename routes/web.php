<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('profile/edit' , [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::post('/friend-request/send/{user}', [FriendController::class, 'sendRequest'])->name('friend.send');
    Route::post('/friend-request/accept/{request}', [FriendController::class, 'acceptRequest'])->name('friend.accept');
    Route::post('/friend-request/reject/{request}', [FriendController::class, 'rejectRequest'])->name('friend.reject');

    Route::get('/friends', [FriendController::class, 'friendsList'])->name('friends.list');
    Route::get('/friend-requests', [FriendController::class, 'pendingRequests'])->name('friend.pending');

    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');
    Route::resource('posts.comments', CommentController::class)->shallow();
    Route::get('/posts/{post}/likes', [PostController::class, 'likes'])->name('posts.likes');

    Route::get('/users_search', [UserSearchController::class, 'index'])->name('users.search');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('/panel', 'dev-panel');
});
