<?php

use App\Http\Controllers\API\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\FriendController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\UserSearchController;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/friends/send/{user}', [FriendController::class, 'sendRequest']);

    Route::get('/friends/pending', [FriendController::class, 'pendingRequests']);

    Route::post('/friends/accept/{request}', [FriendController::class, 'acceptRequest']);

    Route::post('/friends/reject/{request}', [FriendController::class, 'rejectRequest']);

    Route::get('/friends', [FriendController::class, 'friendsList']);

    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile/update', [ProfileController::class, 'update']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);

    Route::put('/posts/{post}', [PostController::class, 'update']); // PUT spoof
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::post('/comments/{comment}', [CommentController::class, 'update']); // PUT spoof
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle']);

    Route::get('/posts/{post}/likes', [PostController::class, 'likes']);

    Route::get('/users/search', [UserSearchController::class, 'search']
);
});
