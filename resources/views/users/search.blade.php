@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="GET" action="{{ route('users.search') }}">
            <input type="text" name="q" value="{{ $query }}" placeholder="Search users..."
                class="form-control mb-3">
        </form>

        @foreach ($users as $user)
            <div class="card mb-2 p-3 d-flex flex-row align-items-center">
                <img src="{{ $user->profile->image ?? 'https://via.placeholder.com/40' }}" width="40"
                    class="rounded-circle me-3">

                <div class="flex-grow-1">
                    <strong>{{ $user->name }}</strong><br>
                    <small>{{ $user->email }}</small>
                </div>

                <a href="{{ route('friend.send', $user->id) }}" class="btn btn-sm btn-primary">
                    Add Friend
                </a>
            </div>
        @endforeach
    </div>
@endsection
